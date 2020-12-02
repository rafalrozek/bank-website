<div class="container">
    <div class="row mt-4 mb-3 ">

        <div class="col-md-8 col-xs-12 mb-4 mb-md-0">
        <?php if(session()->get('addLoan')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=session()->get('addLoan')?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php endif ?>
        <?php if(session()->get('payoff')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('payoff') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
        <?php if(session()->get('payofferr')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->get('payofferr') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
            <div class="col-md-12 bg-white shadow p-3">
                
                <h1 style="float: left">Witaj, <?=esc(session()->get('firstname'))?></h1>
                <span class="pull-right">
                    <a href="/client/logout" style="float: right" data-toggle="tooltip" data-placement="top" title="Wyloguj sie"><img alt="Wyloguj" src="/assets/icons/logout.png" width="16" height="16" ></a>
                </span>
                <div class="clearfix"></div>
                <hr />
                <h2 class=" ml-3" style="float:left"><?= $balance ?>,00 PLN</h2>
                <span data-toggle="modal" data-target="#pozyczkaModal">
                <a href="#" style="float: left; margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Dodaj pożyczke" ><img alt="Wyloguj" src="/assets/icons/add.png" width="16" height="16" ></a>
                </span>
                
                <div class="clearfix"></div>
            </div>
            <!-- POZYCZKA MODAL !-->
            <div class="modal fade" id="pozyczkaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dodaj pożyczke</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM !-->
                    <form method="POST" action="/client/addLoan">
                    <div class="col-12">
                    <p>Podaj kwote:</p>
                    <div class="form-group">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="number" class="form-control" name="money" id="money" placeholder="Kwota" min="10" max="1000" value=100>
                    </div>
  

                    
                    </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
            <!-- END POZYCZKA MODAL !-->
            <!-- START PAYOFF MODAL !-->
            <div class="modal fade" id="payoffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Potwierdzenie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <!-- FORM !-->
                    <form method="POST" action="/client/payoff">
                    <div class="col-12">
                    <p>Czy napewno chcesz spłacić pożyczke?</p>
                    <div class="form-group">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="loanid" id="loanid" value="0"/>
                        <input type="hidden" name="loanmoney" id="loanmoney" value="0"/>
                    </div>
                    </div>
    
                    </div>

                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Potwierdź</button>
                    </div>
                    </form>
                    </div>
                    
                </div>
                </div>

<!-- END PAYOFF MODAL !-->
            
            <div class="col-md-12 bg-white shadow p-3 mt-3">
                <h3>Twoje pożyczki</h1>
                <hr />
                <?php if(count($loans) > 0):?>
                    <table class="table sortable">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kwota</th>
                        <th scope="col">Data Spłaty</th>
                        <th scope="col"><img alt="Spłać" src="/assets/icons/pay.png" width="32" height="32" ></a></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($loans as $l){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$l['Money']." PLN</td>";
                        echo "<td>".$l['DateEnd']."</td>";
                        echo "<td><span onclick='document.getElementById(\"loanid\").value = ".$l['LoanId']."; document.getElementById(\"loanmoney\").value = ".$l['Money']."' data-toggle='modal' data-target='#payoffModal'><a href='#'>Spłać</a></span</td> ";
                        echo "</tr>";
                        $i += 1;
                    }
                    ?>

                    </tbody>
                    </table>
                <?php else: ?>
                <p class="ml-3"> Brak pożyczek </p>
                <?php endif ?>
            
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="col-md-12 bg-white shadow p-3">
            <h3>Twoje zgłoszenia</h1>
                <hr />
                <p class="ml-3"> Brak zgłoszeń </p>
            </div>
            <div class="col-md-12 bg-white shadow p-3 mt-3">
            <h3>Utwórz zgłoszenie</h3>
            <hr />
            <form method="post" action="/client/report">
            <div class="col-12 mt-4">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Temat">
            </div>
            <div class="form-group">
               <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
               
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Opis"></textarea>
            </div>

            <button type="submit" class="btn btn-primary d-block mx-auto px-4">Wyślij</button>
            </div>
            </form>
            </div>
        </div>
        
    </div>
    


</div>
    