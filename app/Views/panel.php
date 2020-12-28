<div class="container mt-5">
        <div class="d-flex justify-content-center">

            <div class="bg-white p-5 m-4 shadow" style="width:300px" >
                <a href="/client">
                <img class="mx-auto d-block" width="100px" height="100px" src="assets/icons/account1.png" />
                <p class="mt-4 text-center">Panel klienta</p></a>
            </div>
            <div class="bg-white p-5 m-4 shadow" style="width:300px" >
                <a href="/settings">
                <img class="mx-auto d-block" width="100px" height="100px" src="assets/icons/settings.png" />
                <p class="mt-4 text-center">Ustawienia</p></a>
            </div>
            <?php if(session()->get('admin')): ?>
            <div class="bg-white p-5 m-4 shadow" style="width:300px" >
                <a href="/admin">
                <img class="mx-auto d-block" width="100px" height="100px" src="assets/icons/admin.png" />
                <p class="mt-4 text-center">Panel admina</p></a>
            </div>
            <?php endif ?>



        </div>
</div>


 