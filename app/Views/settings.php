<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 mx-auto bg-white shadow p-3">
        <h2>Ustawienia</h2>
        <hr />
        <form method="POST" action="/client/editprofile">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="col-12">
                    <?php if(session()->get('editprofile')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->get('editprofile') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    <?php endif ?>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Imie</label>
                            <input type="text" class="form-control" name="firstname" value='<?=$contact[0]['FirstName']?>'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nazwisko</label>
                            <input type="text" class="form-control" name="secondname" value="<?=$contact[0]['SecondName']?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Adres</label>
                            <input type="text" class="form-control" name="address" value="<?=$contact[0]['Addres']?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                        <a href="/panel"><button type="button" class="btn btn-secondary">Wróć</button></a>
                    </div>
        </form>
        </div>


    </div>
</div>


 