<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper shadow">
            <div class="container block-center">
                <p class="text-center h1">Witaj!</p>
                        <img src="/assets/icons/banking.png" height="80px" width="80px" class="img-responsive d-block mx-auto mt-4" alt="Bank immage" > </img>
                            <form class="mt-4" method="POST">
                                <h5>Rejestracja</h5>
                                <hr class="m-0" />
                                <div class="row mt-4">
                                    
                                    <?php if ($validation==true && count($validation->getErrors()) > 0): ?>
                                        <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                        <ul>
                                        <?php foreach ($validation->getErrors() as $error) : ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                        </ul>
                                    </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                   
                                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname') ?>" placeholder="Imie">
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                    
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>" placeholder="Nazwisko">
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <div class="form-group">
                                    
                                    <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" placeholder="Email">
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                   
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Hasło">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                    
                                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="Powtórz hasło">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-block mx-auto px-4">Zarejestruj</button>
                            </form>
                        <div class="mx-100" style="margin-top: 100px">
                        <small  class="form-text text-center text-muted">Masz już konto? Przejdź do <a href="/login">logowania</a>.</small>
                        </div>    

            
            </div>
        </div>
    </div>
</div>
    