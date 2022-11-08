<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <h1>SISTEM INFORMASI MANAJEMEN MUATAN KONTAINER</h1>
                        <h2>PT. SARANA TRANS SUMATERA</h2>
                    </div>
                    <div class="col-md-6 mb-2">
                        <img
                            height="100%"
                            width="100%"
                            class=""
                            src="/img/default.png"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.title = documentTitle + "Dashboard";
    }
};
</script>
