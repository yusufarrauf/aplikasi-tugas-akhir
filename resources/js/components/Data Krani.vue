<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Data Krani</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Krani</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="text-center">Username</th>
                                    <th scope="col" class="text-center">Handphone</th>
                                    <th scope="col" class="text-center">Region</th>
                                    <th scope="col" class="text-center">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(da, index) in krani" :key="da.id">
                                    <td class="text-center">{{ index +1 }}</td>
                                    <td class="font-weight-bold">{{ da.nama }}</td>
                                    <td class="text-center">{{ da.username }}</td>
                                    <td class="text-center">{{ da. handphone }}</td>
                                    <td class="text-center">{{ da.region }}</td>
                                    <td class="text-center">
                                        <a href="#" @click="editData(da)"><i class="fa fa-edit text-blue"></i></a>
                                        ||
                                        <a href="#" @click="deleteData(da)"><i class="fa fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2 mt-3">
                        <button type="button" @click="insertData()" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-plus"></i>
                            Tambah Data Krani</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 v-show="editmode" class="modal-title">Ubah Data Krani</h4>
                        <h4 v-show="!editmode" class="modal-title">Tambah Data Krani</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form @submit.prevent="editmode ? edit() : insert()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left">Nama Lengkap</label>
                                <div class="col">
                                    <input v-model="form.nama" type="text" name="nama" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('nama') }"
                                        placeholder="Masukan Nama Lengkap">
                                    <has-error :form="form" field="nama"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left">Handphone</label>
                                <div class="col">
                                    <input v-model="form.handphone" type="text" name="handphone" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('handphone') }"
                                        placeholder="Masukan Nomor Handphone">
                                    <has-error :form="form" field="handphone"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left">Region</label>
                                <div class="col">
                                    <select v-model="form.region" id="region" name="region" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('region') }">
                                        <option value hidden selected>- Pilih Region -</option>
                                        <option value="Cilegon">Cilegon</option>
                                        <option value="Serang">Serang</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Jakarta">Jakarta</option>
                                        <option value="Medan">Medan</option>
                                        <option value="Makasar">Makasar</option>
                                        <option value="Bandung">Bandung</option>
                                    </select>
                                    <has-error :form="form" field="region"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left">Username</label>
                                <div class="col">
                                    <input v-model="form.username" type="text" name="username" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('username') }"
                                        placeholder="Masukan Username">
                                    <has-error :form="form" field="username"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left">Password</label>
                                <div class="col">
                                    <input v-model="form.password" type="password" name="password" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                        placeholder="Masukan Password">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-show="editmode" :disabled="form.busy"
                                class="btn btn-md btn-success float-right mr-2" type="submit">Update</button>
                            <button v-show="!editmode" :disabled="form.busy"
                                class="btn btn-md btn-primary float-right mr-2" type="submit">Simpan</button>
                            <button class="btn btn-md btn-danger float-right mr-2" type="button"
                                data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                krani: {},
                form: new Form({
                    id: '',
                    user_id: '',
                    nama: '',
                    handphone: '',
                    region: '',
                    username: '',
                    password: '',
                }),

            }
        },
        methods: {
            LoadData() {
                axios.get('/api/data_krani').then(({
                    data
                }) => (this.krani = data))
            },
            insertData() {
                this.editmode = false;
                this.form.reset();
                $('#modal').modal('show')
            },
            insert() {
                this.$Progress.start();
                this.form.post('/api/data_krani')
                    .then(() => {
                        Fire.$emit('reloadData');
                        $('#modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Krani Berhasil Ditambahkan'
                        });
                        this.$Progress.finish();
                        this.form.reset();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!!'
                        });
                        this.$Progress.fail();
                    });
            },
            editData(da) {
                this.editmode = true;
                this.form.fill(da);
                $('#modal').modal('show');
            },
            edit() {
                this.$Progress.start();
                this.form.put('/api/data_krani/' + this.form.id)
                    .then(() => {
                        Fire.$emit('reloadData');
                        $('#modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Krani Berhasil Diubah'
                        });
                        this.$Progress.finish();
                        this.form.reset();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!!'
                        });
                        this.$Progress.fail();
                    });
            },
            deleteData(da) {
                Swal.fire({
                    title: 'Anda Yakin Ingin Menghapus Data Krani "' + da.nama + '" ?',
                    // text: "Data Yang Sudah Dihapus Tidak Dapat Kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/api/data_krani/' + da.id).then(() => {
                            Swal.fire(
                                'Terhapus!',
                                'Data Krani "' + da.nama + '" Berhasil Dihapus.',
                                'success',
                            );
                            Fire.$emit('reloadData');
                        }).catch(() => {
                            Swal.fire("Error!!", "Terjadi Kesalahan Saat Menghapus Data", "warning");
                        });
                    }
                })
            },
        },
        created() {
            this.LoadData();
            Fire.$on('reloadData', () => {
                this.LoadData();
            });
        },
        mounted() {
            document.title = documentTitle + 'Data Krani';
            this.dt = $("#table").DataTable({
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        },
        watch: {
            krani(val) {
                this.dt.destroy();
                this.$nextTick(() => {
                    this.dt = $("#table").DataTable({
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'print'
                        ]
                    });
                })
            },
        }
    }

</script>
