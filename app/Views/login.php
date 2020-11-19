<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper shadow">
            <div class="container block-center">
                <p class="text-center h1">Witaj!</p>
                        <img src="/assets/icons/banking.png" height="80px" width="80px" class="img-responsive d-block mx-auto mt-4" alt="Bank immage" > </img>
                            <form class="mt-4" method="post" action="/login">
                                <h5>Logowanie</h5>
                                <hr class="m-0" />
                                <div class="col-12 mt-4">
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
                                <?php if(session()->get('logOut')): ?>
                                    <div class="alert alert-success" role="alert">
                                    <?= session()->get('logOut') ?>
                                </div>
                                <?php endif; ?>    
                                <?php if(session()->get('registerSuccess')): ?>
                                    <div class="alert alert-success" role="alert">
                                    <?= session()->get('registerSuccess') ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(session()->get('confirmSuccess')): ?>
                                    <div class="alert alert-success" role="alert">
                                    <?= session()->get('confirmSuccess') ?>
                                    </div>
                                <?php endif; ?>
 
                                    <div class="form-group">
                                    <small class="form-text text-muted"></small>
                                    <input type="text" class="form-control" name="email" id="email" value="" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="form-group">
                                    <small class="form-text text-muted"></small>
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Hasło">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-block mx-auto px-4">Zaloguj</button>
                            </form>
                        <div class="mx-100" style="margin-top: 100px">
                        <small  class="form-text text-center text-muted">Nie masz konta? Przejdź do <a href="/register">rejestracji</a>.</small>
                        </div>    

            
            </div>
        </div>
    </div>
</div>
    