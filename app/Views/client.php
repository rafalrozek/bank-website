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
        <?php if(session()->get('reportAdd')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('reportAdd') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
        <?php if(session()->get('editprofile')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('editprofile') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
        <?php if(session()->get('transactionerr')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->get('transactionerr') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
        <?php if(session()->get('transaction')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('transaction') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
            <div class="col-md-12 bg-white shadow p-3">
                
                <h1 style="float: left">Witaj, <?=esc($contact[0]['FirstName'])?></h1>
                <span class="pull-right">
                
                    <a href="/client/logout" style="float: right" data-toggle="tooltip" data-placement="top" title="Wyloguj sie"><img alt="Wyloguj" src="/assets/icons/logout.png" width="16" height="16" ></a>
                    
                    <a href="/panel" style="float: right; margin-right: 10px" data-toggle="tooltip" data-placement="top" title="Panel"><img alt="Home" src="/assets/icons/home.png" width="18" height="18" ></a>
                    
                </span>
                <div class="clearfix"></div>
                <hr />
                <h2 class=" ml-3" style="float:left"><?= $balance ?>,00 PLN</h2>
                
                <span data-toggle="modal" data-target="#pozyczkaModal">
                <a style="float: left; margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Dodaj pożyczke" ><img alt="Dodaj pożyczke" src="/assets/icons/add.png" width="16" height="16" ></a>
                </span>
                <span data-toggle="modal" data-target="#transactionModal">
                <a style="float: left; margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Wykonaj przelew" ><img alt="Przelew" src="/assets/icons/exchange.png" width="16" height="16" ></a>
                </span>
                
                <div class="clearfix"></div>
            </div>
            <!-- TRANSACTION MODAL !-->
            <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Prześlij PLN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM !-->
                    <form method="POST" action="/client/transaction">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" name="email" placeholder='Email'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kwota</label>
                            <input type="number" class="form-control" name="amount" value="100" min="10" max=<?=$balance?> >
                        </div>
  
                    </div>
                    
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary">Wyślij</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
            <!-- END TRANSACTION MODAL !-->

            <!-- SETTINGS MODAL !-->
                        <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ustawienia konta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM !-->
                    <form method="POST" action="/client/editprofile">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="col-12">
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
            <!-- END SETTINGS MODAL !-->
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
                        <th style='width: 50px' scope="col">#</th>
                        <th scope="col">Kwota</th>
                        <th scope="col">Data Spłaty</th>
                        <th class='text-center' scope="col"><img alt="Spłać" src="/assets/icons/pay.png" width="32" height="32" ></a></th>
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
                        echo "<td class='text-center'><span onclick='document.getElementById(\"loanid\").value = ".$l['LoanId']."; document.getElementById(\"loanmoney\").value = ".$l['Money']."' data-toggle='modal' data-target='#payoffModal'><a  data-toggle='tooltip' data-placement='bottom' title='Spłać pożyczke' href='#'>Spłać</a></span</td> ";
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
            <div class="col-md-12 bg-white shadow p-3 mt-3">
                <h3>Historia transakcji</h1>
                <hr />
                <?php if(count($history) > 0):?>
                    <table class="table">
                    <thead>
                        <tr>
                        <th style='width: 50px' scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Kwota</th>
                        <th scope="col">Nadawca</th>
                        <th scope="col">Odbiorca</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($history as $h){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$h['date']."</td>";
                        if($h['user_from'] == $_SESSION['id']){
                            echo "<td class='text-danger font-weight-bold'>-".$h['amount']."</td>";
                        }
                        else{
                            echo "<td class='text-success font-weight-bold'>+".$h['amount']."</td>";
                        }
                        echo "<td class='small'>".$h['email_from']."</td>";
                        echo "<td class='small'>".$h['email_to']."</td>";
                        echo "</tr>";
                        $i += 1;
                    }
                    ?>

                    </tbody>
                    </table>
                <?php else: ?>
                <p class="ml-3"> Brak transakcji </p>
                <?php endif ?>
            
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="col-md-12 bg-white shadow p-3">
            <h3>Twoje zgłoszenia</h1>
            <hr />
            <?php if(count($reports) > 0):?>
                    <table class="table">
                    <thead>
                        <tr>
                        <th style='width: 20px' scope="col">#</th>
                        <th style='width: 118px' scope="col">Data</th>
                        <th scope="col">Temat</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($reports as $r){
                        echo "<tr data-toggle='collapse' data-target='#acc".$i."' class='crow' >";
                        echo "<td>".$i."</td>";
                        echo "<td>".substr($r['ReportDate'],0,10)."</td>"; //print without 
                        echo "<td>".esc($r['Title'])."</td>";
                        echo "<td class='text-center'>";
                        if($r['Status'] == 0)
                            echo "<img data-toggle='tooltip' data-placement='top' title='Nierozwiązany' alt='ok' src='/assets/icons/wrong.png' width='16' height='16' >";
                        else
                            echo "<img data-toggle='tooltip' data-placement='top' title='Rozwiązany' alt='ok' src='/assets/icons/tick.png' width='16' height='16' >";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>
                        <td colspan='4' class='p-0'>
                            <div id='acc".$i."' class='collapse small' style='padding: 8px' aria-expanded='false'>";
                        foreach($r['messages'] as $m){
                            if($m['UserId'] == $_SESSION['id']){
                                echo "<small>Ty:</small>";
                                echo "<div class='text-dark font-italic p-2 col-6' style='background-color: lightcyan'>".esc($m['comment'])."</div>";
                                echo "<div class='clearfix'></div>";
                                
                            }
                            else{
                                echo "<small>Obsługa:</small>";
                                echo "<div class='text-dark font-italic pt-2 col-6 float-right' style='background-color: lightgray'>".esc($m['comment'])."</div>";
                                echo "<div class='clearfix'></div>";
                            }
                            
                        }
                        echo "<hr class='m-0 mt-2'/>";
                        if($r['Status'] == 0){ ?>
                        
                        <div class="col-12 p-2 pt-1">
                            <form method="post" action="/client/message">
                                <div class='row'>
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="reportid" value="<?= $r['ReportId'] ?>"/>
                                    <input type="text" class="form-control" style='width: 80%; height: 32px' name="msg" id="msg" placeholder="...">
                                    <button type="submit" style='width: 20%; height:  32px; font-size: 12px' class="form-control-sm btn btn-primary  mx-auto">Wyślij</button>
                                </div>
                            </form>
                            </div>
                            <?php 
                        }
                        else{
                            ?>
                        <div class="small text-center pt-2">
                            Obsługa zamknęła zgłoszenie.
                        </div>
                        <?php
                        }

                        echo "</td>";
                        echo "</tr>";
                        $i += 1;
                    }
                    ?>

                    </tbody>
                    </table>
                <?php else: ?>
                <p class="ml-3"> Brak zgłoszeń </p>
                <?php endif ?>
            </div>

<!-- !-->


            <!-- !-->
            <div class="col-md-12 bg-white shadow p-3 mt-3">
            <h3>Utwórz zgłoszenie</h3>
            <hr />
            <form method="post" action="/client/report">
            <div class="col-12 mt-4">
            <div class="form-group">
                <input type="text" class="form-control" name="title" id="title" placeholder="Temat">
            </div>
            <div class="form-group">
               <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
               
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Opis"></textarea>
            </div>

            <button type="submit" class="btn btn-primary d-block mx-auto px-4">Wyślij</button>
            </div>
            </form>
            </div>
        </div>
        
    </div>
    


</div>
    