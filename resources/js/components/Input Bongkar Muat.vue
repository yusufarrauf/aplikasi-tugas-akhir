<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Input Bongkar Muat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Input Bongkar Muat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <form @submit.prevent="insert()" @keydown="form.onKeydown($event)">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-md-left">Jenis</label>
                                        <div class="col">
                                            <select v-model="form.jenis" id="jenis" name="jenis" class="form-control" required>
                                                <option value hidden selected>- Bongkar/Muat -</option>
                                                <option value="Bongkar">Bongkar</option>
                                                <option value="Muat">Muat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-md-left">Krani</label>
                                        <div class="col">
                                            <select v-model="form.krani" id="krani" name="krani" class="form-control" required>
                                                <option value hidden selected>- Pilih Krani -</option>
                                                <option v-for="da in data_krani" :value="da.id" :key="da.id">{{ da.nama }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-md-left">Tujuan</label>
                                        <div class="col">
                                            <input v-model="form.tujuan" type="text" name="tujuan" class="form-control" required
                                                placeholder="Masukan tujuan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-md-left">Kota</label>
                                        <div class="col">
                                            <select v-model="form.kota" id="kota" name="kota" class="form-control" required>
                                                <option value hidden selected>- Pilih Kota -</option>
                                                <option value="Cilegon">Cilegon</option>
                                                <option value="Serang">Serang</option>
                                                <option value="Riau">Riau</option>
                                                <option value="Jakarta">Jakarta</option>
                                                <option value="Medan">Medan</option>
                                                <option value="Makasar">Makasar</option>
                                                <option value="Bandung">Bandung</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                            <div class="card-body text-center">
                                <h3>Data Kontainer</h3>
                            </div>
                        </div>
                        </div>
                        <div v-for="(dp, index) in form.data_kontainer" class="col-md-12 row" :key="index">
                            <div class="col-md-11">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-md-left">Supir</label>
                                            <div class="col">
                                                <select v-model="dp.supir" id="supir" name="supir" class="form-control"
                                                    required @change="getNopol(dp.supir, index)">
                                                    <option value hidden selected>- Pilih Supir -</option>
                                                    <option v-for="da in data_supir" :value="da.id" :key="da.id">
                                                        {{ da.nama }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-md-left">Nopol Kendaraan</label>
                                            <div class="col">
                                                <input v-model="dp.nopol_kendaraan" type="text" name="nopol_kendaraan"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-md-left">Nomor
                                                Kontainer</label>
                                            <div class="col">
                                                <input v-model="dp.nomor_kontainer" type="text" name="nomor_kontainer"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-md-left">Nomor
                                                Segel</label>
                                            <div class="col">
                                                <input v-model="dp.nomor_segel" type="text" name="nomor_segel"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div v-show="index > 0" class="form-group">
                                    <button type="button" @click="deleteList(index)" class="btn btn-danger btn-block">
                                        <i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row justify-content-center">
                            <div class="col-md-4 col-sm-12 mb-2 mt-3">
                                <button type="button" @click="addList()" class="btn btn-success btn-lg btn-block">
                                    <i class="fas fa-plus"></i>
                                    Tambah Data</button>
                            </div>
                        </div>
                        <div class="offset-8 col-md-4 mb-5 mt-5">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data_krani: {},
                data_supir: {},
                form: new Form({
                    jenis: '',
                    krani: '',
                    tujuan: '',
                    kota: '',
                    data_kontainer: [{
                        supir: '',
                        nopol_kendaraan: '',
                        nomor_kontainer: '',
                        nomor_segel: ''
                    }],
                }),
            }
        },
        methods: {
            LoadData() {
                axios.get('/api/data_supir').then(({
                    data
                }) => (this.data_supir = data))
                axios.get('/api/data_krani').then(({
                    data
                }) => (this.data_krani = data))
            },
            getNopol(id, index){
                axios.get('/api/data_supir/' + id).then(({
                    data
                }) => (this.form.data_kontainer[index].nopol_kendaraan = data))
            },
            insert() {
                this.$Progress.start();
                this.form.post('/api/input_bongkar_muat')
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Input Bongkar Muat Berhasil Disimpan'
                        });
                        this.$Progress.finish();
                        this.form.reset();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Periksa Kembali Data Pesanan! Pastikan Semua Sudah Terisi Dengan Benar!!'
                        });
                        this.$Progress.fail();
                    });
            },
            addList() {
                let dp = {
                    supir: '',
                    nopol_kendaraan: '',
                    nomor_kontainer: '',
                    nomor_segel: ''
                };
                this.form.data_kontainer.push(dp);
            },
            deleteList(index) {
                this.form.data_kontainer.splice(index, 1);
            }
        },
        created() {
            this.LoadData();
            Fire.$on('reloadData', () => {
                this.LoadData();
            });
        },
        mounted() {
            document.title = documentTitle + 'Input Bongkar Muat';
        },
    }

</script>
