<style>

.dataTables_length {
display: none;
}
.dataTables_info {
display: none;
}
.dataTables_filter {
text-align: left !important;
}

label {
    display: block;
    float: left;
    width: 100%;
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0;
    display: block;
    width:100%;
}

div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    justify-content: flex-start;
}
</style>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
		"dom": '<"top"f>rt<"bottom"p><"clear">',
    "pagingType": "simple_numbers", // "simple" option for 'Previous' and 'Next' buttons only
	"pageLength": 10,
	
	"oLanguage": {

		"sSearch": "Wyszukaj",
		"sZeroRecords": "Brak wyników :(",
		
		"oPaginate":{
			"sNext": "Następna",
			"sPrevious" : "Poprzednia"
		}
	

}

    });
});

</script>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-10 mx-auto bg-white shadow p-3">
        <?php if(session()->get('sendMessage')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('sendMessage') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
        <?php if(session()->get('reportRemove')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('reportRemove') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif ?>
        <h2 style="float: left">Zgłoszenia</h2>
        <span class="pull-right">
                
                    <a href="/client/logout" style="float: right" data-toggle="tooltip" data-placement="top" title="Wyloguj sie"><img alt="Wyloguj" src="/assets/icons/logout.png" width="16" height="16" ></a>
                    
                    <a href="/panel" style="float: right; margin-right: 10px" data-toggle="tooltip" data-placement="top" title="Panel"><img alt="Home" src="/assets/icons/home.png" width="18" height="18" ></a>
                    
                </span>
                <div class="clearfix"></div>
        <hr />
<!-- BEGIN REPORTS !-->

                    <table class="table" id="reportsTable">
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
                        echo "<td >";
                        if($r['Status'] == 0){
                            echo "<img  data-toggle='tooltip' data-placement='top' title='Nierozwiązany' alt='ok' src='/assets/icons/wrong.png' width='16' height='16' >";
                        }
                        else
                            echo "<img  data-toggle='tooltip' data-placement='top' title='Rozwiązany' alt='ok' src='/assets/icons/tick.png' width='16' height='16' >";
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
                                echo "<small class='float-right d-block'>Klient:</small>";
                                echo "<div class='clearfix'></div>";
                                echo "<div class='text-dark font-italic p-2 col-6 float-right' style='background-color: lightgray'>".esc($m['comment'])."</div>";
                                echo "<div class='clearfix'></div>";
                            }
                            
                        }
                        echo "<hr class='m-0 mt-2'/>";
                        if($r['Status'] == 0){ ?>
                        
                        <div class="col-12 p-2 pt-1">
                            <form method="post" action="/admin/message">
                                <div class='row'>
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="reportid" value="<?= $r['ReportId'] ?>"/>
                                    <input type="text" class="form-control" style='width: 80%; height: 32px' name="msg" id="msg" placeholder="...">
                                    <button type="submit" style='width: 20%; height:  32px; font-size: 12px' class="form-control-sm btn btn-primary  mx-auto">Wyślij</button>
                                </div>
                            </form>
                            <a class='d-block mx-auto text-center m-2' href='/admin/closeReport/<?= $r['ReportId'] ?>'>Zamknij zgłoszenie</a>
                            </div>
                            <?php
                            echo ""; 
                        }
                        else{
                            ?>
                        <div class="small text-center pt-2">
                            Obsługa zamknęła zgłoszenie.
                        </div>
                        <?php
                        }

 
                        $i += 1;
                    }
                    ?>

                    </tbody>
                    </table>
 


<!-- END REPORTS !-->



    </div>

    <div class="col-md-10 mx-auto bg-white shadow p-3 mt-4">
    <h2>Użytkownicy</h2>
        <hr />
        <table class="table" id="usersTable">
                    <thead>
                        <tr>
                        <th  style='width: 70px'scope="col">#</th>
                        <th  scope="col">UserID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aktywne</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($users as $u){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$u['UserId']."</td>"; 
                        echo "<td>".$u['Email']."</td>";
                        if($u['active'] == 0)
                            echo "<td><img  data-toggle='tooltip' data-placement='top' title='Nieaktywne' alt='ok' src='/assets/icons/wrong.png' width='16' height='16' ><span style='display:none;'>N</span></td>";
                        else
                            echo "<td><img  data-toggle='tooltip' data-placement='top' title='Rozwiązany' alt='ok' src='/assets/icons/tick.png' width='16' height='16' ><span style='display:none;'>R</span></td>";
                        echo "</tr>";
                        $i += 1;
                    }
                    ?>

                    
                    </tbody>
                    </table>

    </div>
    </div>
</div>