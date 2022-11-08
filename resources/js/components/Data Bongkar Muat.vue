<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Data Bongkar dan Muat Kontainer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Bongkar dan Muat Kontainer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <table id="table1" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Tanggal</th>
                                    <th scope="col" class="text-center">Jenis</th>
                                    <th scope="col" class="text-center">Tujuan</th>
                                    <th scope="col" class="text-center">Kota</th>
                                    <th scope="col" class="text-center">Supir</th>
                                    <th scope="col" class="text-center">Nomor Polisi</th>
                                    <th scope="col" class="text-center">Nomor Kontainer / Segel</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="da in bongkar_muat" :key="da.id">
                                    <td class="text-center">{{ da.created_at | dateReformat }}</td>
                                    <td class="text-center">{{ da.jenis }}</td>
                                    <td class="text-center">{{ da.tujuan }}</td>
                                    <td class="text-center">{{ da.kota }}</td>
                                    <td class="text-center">{{ da.nama_supir }}</td>
                                    <td class="text-center">{{ da.nopol }} - {{ da.jenis_kontainer }}</td>
                                    <td class="text-center">{{ da.nomor_kontainer }} / {{ da.nomor_segel }}</td>
                                    <td v-if="da.status == 'Created'" class="text-center">
                                        <button type="button" @click="updateStatus(da, 'Arrive')"
                                            class="btn btn-primary">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Sudah Tiba</button>
                                    </td>
                                    <td v-else-if="da.status == 'Arrive'" class="text-center">
                                        <button type="button" @click="updateStatus(da, 'Inspection')"
                                            class="btn btn-danger">
                                            <i class="fas fa-tasks"></i>
                                            Inspeksi</button>
                                    </td>
                                    <td v-else-if="da.status == 'Inspection'" class="text-center">
                                        <button type="button" @click="updateStatus(da, 'Mode')"
                                            class="btn btn-warning">
                                            <i class="fas fa-truck"></i>
                                            Load / Unload</button>
                                    </td>
                                    <td v-else class="text-center">
                                        <button type="button" @click="updateStatus(da, 'Done')" class="btn btn-success">
                                            <i class="fas fa-check"></i>
                                            Selesai</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <div class="card-header">Laporan Data Bongkar dan Muat</div>
                            <div class="card-body">
                                <table id="table2" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Tanggal</th>
                                    <th scope="col" class="text-center">Jenis</th>
                                    <th scope="col" class="text-center">Tujuan</th>
                                    <th scope="col" class="text-center">Kota</th>
                                    <th scope="col" class="text-center">Supir</th>
                                    <th scope="col" class="text-center">Nomor Polisi</th>
                                    <th scope="col" class="text-center">Nomor Kontainer / Segel</th>
                                    <th scope="col" class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="da in bongkar_muat_done" :key="da.id">
                                    <td class="text-center">{{ da.created_at | dateReformat }}</td>
                                    <td class="text-center">{{ da.jenis }}</td>
                                    <td class="text-center">{{ da.tujuan }}</td>
                                    <td class="text-center">{{ da.kota }}</td>
                                    <td class="text-center">{{ da.nama_supir }}</td>
                                    <td class="text-center">{{ da.nopol }} - {{ da.jenis_kontainer }}</td>
                                    <td class="text-center">{{ da.nomor_kontainer }} / {{ da.nomor_segel }}</td>
                                    <td  class="text-center"> Selesai </td>
                                </tr>
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ title }} NOPOL : {{ nopol }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form @submit.prevent="update()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <img width="100%" height="200px" class="mb-2" :src="image">
                                        <span class="btn btn-success btn-file">
                                            Browse… <input name="photo" type="file" @change="selectFile" readonly>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button :disabled="form.busy" class="btn btn-md btn-primary float-right mr-2"
                                type="submit">Simpan</button>
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
                user_id: document.querySelector('meta[name="user_id"]').content,
                image: '',
                title: '',
                nopol: '',
                bongkar_muat: {},
                bongkar_muat_done: {},
                form: new Form({
                    id: '',
                    jenis: '',
                    status: '',
                    photo: '',
                }),

            }
        },
        methods: {
            LoadData() {
                let userID = this.user_id;
                axios.get('/api/bongkar_muat').then(({
                    data
                }) => {
                    let obj = _.pickBy(data, function (u) {
                        return (u.id_user == userID && u.status != 'Done');
                    });
                    this.bongkar_muat = Object.keys(obj).map(i => obj[i]);
                    obj = _.pickBy(data, function (u) {
                        return (u.id_user == userID && u.status == 'Done');
                    });
                    this.bongkar_muat_done = Object.keys(obj).map(i => obj[i]);
                })
            },
            selectFile(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.viewImage(files[0]);
            },
            viewImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.form.photo = reader.result;
                };
                reader.readAsDataURL(file);
                // this.form.photo = reader.result;
            },
            updateStatus(da, mode) {
                this.image = '',
                this.form.fill(da);
                this.form.status = mode;
                if(mode == "Mode"){
                    if(da.jenis == 'Bongkar'){
                        mode = "Unload"
                    } else {
                        mode = "Load"
                    }
                }

                if (mode == "Arrive" || mode == "Done") {
                    this.update();
                } else {
                    this.title = mode;
                    this.nopol = da.nopol;
                    $('#modal').modal('show')
                }
            },
            update() {
                this.$Progress.start();
                this.form.post('/api/update_bongkar_muat')
                    .then(() => {
                        Fire.$emit('reloadData');
                        $('#modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Status Data Bongkar dan Muat Kontainer Berhasil Di Ubah'
                        });
                        this.$Progress.finish();
                        this.form.reset();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Silahkan Upload Gambar!!'
                        });
                        this.$Progress.fail();
                    });
            },
        },
        created() {
            this.LoadData();
            Fire.$on('reloadData', () => {
                this.LoadData();
            });
        },
        mounted() {
            document.title = documentTitle + 'Data Bongkar dan Muat Kontainer';
            this.dt = $("#table1").DataTable({
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
            this.ac = $("#table2").DataTable({
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        },
        watch: {
            bongkar_muat(val) {
                this.dt.destroy();
                this.$nextTick(() => {
                    this.dt = $("#table1").DataTable({
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'print'
                        ]
                    });
                })
            },
            bongkar_muat_done(val) {
                this.ac.destroy();
                this.$nextTick(() => {
                    this.ac = $("#table2").DataTable({
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'print'
                        ]
                    });
                })
            },
        },
    }

</script>
