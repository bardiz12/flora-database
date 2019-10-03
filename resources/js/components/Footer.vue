<template>
    <footer class="footer mt-auto">
            <b-container class="d-flex justify-content-between align-items-center">
                <div class="text-footer-a">
                    <strong class="text-muted">&copy; Tim KKN Gondang Unnes 2019</strong> | <a href="https://github.com/bardiz12/flora-database"><i class="fa fa-github"></i> Bardiz12</a>
                </div>
                <div class="brand-logo-bawah" >
                    <img src="/assets/images/dikti.png" alt="">
                    <img src="/assets/images/unnes.png" alt="">
                    <img src="/assets/images/gondang.png" style="width" alt="">
                </div>
            </b-container>
    </footer>
</template>

<style scoped lang="scss">

.footer{
    border-top: 1px solid #ddd;
    background: rgb(212, 212, 212);
    flex-shrink: none;
}

.brand-logo-bawah{
    & img {
        height:48px;
    }
}

</style>

