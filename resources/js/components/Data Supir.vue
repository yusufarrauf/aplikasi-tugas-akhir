<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Data Supir</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Supir</li>
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
                                    <th scope="col" class="text-center">Kendaraan</th>
                                    <th scope="col" class="text-center">Tanggal Lahir</th>
                                    <th scope="col" class="text-center">Handphone</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col" class="text-center">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(da, index) in supir" :key="da.id">
                                    <td class="text-center">{{ index +1 }}</td>
                                    <td class="font-weight-bold">{{ da.nama }}</td>
                                    <td class="text-center">{{ da.nopol_kendaraan }} - {{ da.jenis }}</td>
                                    <td class="text-center">{{ da.tanggal_lahir | dateReformat }}</td>
                                    <td class="text-center">{{ da.handphone }}</td>
                                    <td>{{ da.alamat }}</td>
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
                            Tambah Data Supir</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 v-show="editmode" class="modal-title">Ubah Data Supir</h4>
                        <h4 v-show="!editmode" class="modal-title">Tambah Data Supir</h4>
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
                                <label class="col-md-3 col-form-label text-md-left">Tanggal Lahir</label>
                                <div class="col">
                                    <input v-model="form.tanggal_lahir" type="date" name="tanggal_lahir" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('tanggal_lahir') }"
                                        placeholder="Masukan Tanggal Lahir">
                                    <has-error :form="form" field="tanggal_lahir"></has-error>
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
                                <label class="col-md-3 col-form-label text-md-left">Alamat</label>
                                <div class="col">
                                    <input v-model="form.alamat" type="text" name="alamat" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('alamat') }"
                                        placeholder="Masukan Alamat">
                                    <has-error :form="form" field="alamat"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left">Kendaraan</label>
                                <div class="col">
                                    <select v-model="form.nopol_kendaraan" id="nopol_kendaraan" name="nopol_kendaraan" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('nopol_kendaraan') }">
                                        <option value hidden selected>- Pilih Kendaraan -</option>
                                        <option v-for="da in kendaraan" :value="da.nopol" :key="da">{{ da.nopol }} - {{ da.jenis }}</option>
                                    </select>
                                    <has-error :form="form" field="nopol_kendaraan"></has-error>
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
                supir: {},
                kendaraan: {},
                form: new Form({
                    id: '',
                    nama: '',
                    tanggal_lahir: '',
                    handphone: '',
                    alamat: '',
                    nopol_kendaraan: '',
                }),

            }
        },
        methods: {
            LoadData() {
                axios.get('/api/data_supir').then(({
                    data
                }) => (this.supir = data))
                axios.get('/api/data_kendaraan').then(({
                    data
                }) => (this.kendaraan = data))
            },
            insertData() {
                this.editmode = false;
                this.form.reset();
                $('#modal').modal('show')
            },
            insert() {
                this.$Progress.start();
                this.form.post('/api/data_supir')
                    .then(() => {
                        Fire.$emit('reloadData');
                        $('#modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Supir Berhasil Ditambahkan'
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
                this.form.put('/api/data_supir/' + this.form.id)
                    .then(() => {
                        Fire.$emit('reloadData');
                        $('#modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Supir Berhasil Diubah'
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
                    title: 'Anda Yakin Ingin Menghapus Data Supir "' + da.nama + '" ?',
                    // text: "Data Yang Sudah Dihapus Tidak Dapat Kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/api/data_supir/' + da.id).then(() => {
                            Swal.fire(
                                'Terhapus!',
                                'Data Supir "' + da.nama + '" Berhasil Dihapus.',
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
            document.title = documentTitle + 'Data Supir';
            this.dt = $("#table").DataTable({
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        },
        watch: {
            supir(val) {
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
