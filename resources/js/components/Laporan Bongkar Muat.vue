<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Laporan Bongkar dan Muat Kontainer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Laporan Bongkar dan Muat Kontainer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form @submit.prevent="filter()" @keydown="form.onKeydown($event)">
                            <div class="form-group row">
                                <label for="name" class="col-md-1 col-form-label text-md-left">Krani </label>
                                <div class="col-md-3">
                                    <select v-model="form.krani" id="krani" name="krani"
                                        class="form-control text-center" data-live-search="true">
                                        <option value="Semua">== Semua ==</option>
                                        <option v-for="da in data_krani" :value="da.id" :key="da.id">{{ da.nama }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 col-form-label text-md-left">Jenis </label>
                                <div class="col-md-3">
                                    <select v-model="form.jenis" id="jenis" name="jenis"
                                        class="form-control text-center" data-live-search="true">
                                        <option value="Semua">== Semua ==</option>
                                        <option value="Bongkar">Bongkar</option>
                                        <option value="Muat">Muat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 col-form-label text-md-left">Bulan </label>
                                <div class="col-md-3">
                                    <select v-model="form.bulan" id="bulan" name="bulan"
                                        class="form-control text-center" data-live-search="true">
                                        <option value="0">Januari</option>
                                        <option value="1">Februari</option>
                                        <option value="2">Maret</option>
                                        <option value="3">April</option>
                                        <option value="4">Mei</option>
                                        <option value="5">Juni</option>
                                        <option value="6">Juli</option>
                                        <option value="7">Agustus</option>
                                        <option value="8">September</option>
                                        <option value="9">Oktober</option>
                                        <option value="10">November</option>
                                        <option value="11">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 col-form-label text-md-left">Tahun </label>
                                <div class="col-md-3">
                                    <select v-model="form.tahun" id="tahun" name="tahun"
                                        class="form-control text-center" data-live-search="true">
                                        <option v-for="n in 30" :value="2020 + n" :key="n">{{ 2020 + n }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 offset-1">
                                    <button type="submit" class="btn btn-primary float-right ml-2"><i
                                            class="fas fa-search"></i> Cari Data</button>
                                    <button @click="reset()" type="button" class="btn btn-danger float-right ml-2"><i
                                            class="fas fa-undo"></i>
                                        Reset</button>
                                </div>
                            </div>
                        </form>
                        <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Tanggal</th>
                                    <th scope="col" class="text-center">Krani</th>
                                    <th scope="col" class="text-center">Tujuan</th>
                                    <th scope="col" class="text-center">Jenis</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="da in bongkar_muat" :key="da.id">
                                    <td class="text-center align-middle">{{ da.id }}</td>
                                    <td class="text-center align-middle">{{ da.created_at | dateReformat }}</td>
                                    <td class="text-center align-middle">{{ da.nama_krani }}</td>
                                    <td class="text-center align-middle">{{ da.tujuan }}</td>
                                    <td class="text-center align-middle">{{ da.jenis }}</td>
                                    <td class="text-center align-middle">{{ da.status }}</td>
                                    <td class="text-center align-middle">
                                        <button type="button" @click="detailBongkarMuat(da)" class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                            Detail Data</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailData">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail {{ jenis }} Kontainer ID "{{ id }}"</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table id="table2" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Supir</th>
                                    <th scope="col" class="text-center align-middle">Kendaraan</th>
                                    <th scope="col" class="text-center align-middle">Nomor Kontainer</th>
                                    <th scope="col" class="text-center align-middle">Nomor Segel</th>
                                    <th scope="col" class="text-center align-middle"></th>
                                    <th scope="col" class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="da in detail_kontainer" :key="da.id">
                                    <td class="font-weight-bold align-middle">{{ da.nama_supir }}</td>
                                    <td class="text-center align-middle">{{ da.nopol }} - {{ da.jenis }}</td>
                                    <td class="text-center align-middle">{{ da.nomor_kontainer }}</td>
                                    <td class="text-center align-middle">{{ da.nomor_segel }}</td>
                                    <td class="text-center align-middle"></td>
                                    <td class="text-center align-middle">{{ da.status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-md btn-danger float-right mr-2" type="button"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id: '',
                jenis: '',
                data_krani: {},
                bongkar_muat: {},
                detail_kontainer: {},
                form: new Form({
                    krani: 'Semua',
                    jenis: 'Semua',
                    bulan: "",
                    tahun: "",
                }),
            }
        },
        methods: {
            LoadData() {
                axios.get('/api/data_bongkar_muat').then(({
                    data
                }) => (this.bongkar_muat = data));
                axios.get('/api/data_krani').then(({
                    data
                }) => (this.data_krani = data));
                this.form.bulan = new Date().getMonth();
                this.form.tahun = new Date().getFullYear();
            },
            filter() {
                this.form.post('/api/data_bongkar_muat').then(({
                    data
                }) => (this.bongkar_muat = data))
            },
            reset() {
                this.form.reset();
                this.LoadData();
            },
            detailBongkarMuat(da) {
                this.id = da.id;
                this.jenis = da.jenis;
                axios.get('/api/data_bongkar_muat/' + da.id).then(({
                    data
                }) => (this.detail_kontainer = data));
                $('#detailData').modal('show');
            }
        },
        created() {
            this.LoadData();
            Fire.$on('reloadData', () => {
                this.LoadData();
            });
        },
        mounted() {
            document.title = documentTitle + 'Laporan Bongkar dan Muat Kontainer';
            this.dt = $("#table").DataTable({
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
                    this.dt = $("#table").DataTable({
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'print'
                        ]
                    });
                })
            },
            detail_kontainer(val) {
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
        }
    }

</script>
