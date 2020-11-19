<div class="container">
    <div class="row mt-4 mb-3 ">

        <div class="col-md-8 col-xs-12 mb-4 mb-md-0">
            <div class="col-md-12 bg-white shadow p-3">
                
                <h1 style="float: left">Witaj, <?=session()->get('firstname')?></h1>
                <span class="pull-right">
                    <a href="/client/logout"><img alt="Wyloguj" style="float: right" src="/assets/icons/logout.png" width="16" height="16" ></a>
                </span>
                <div class="clearfix"></div>
                <hr />
                <p class="h2 ml-3">0,00 PLN</p>
            </div>

            
            <div class="col-md-12 bg-white shadow p-3 mt-3">
                <h3>Twoje zgłoszenia</h1>
                <hr />
                <p class="ml-3"> Brak zgłoszeń </p>
            
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="col-md-12 bg-white shadow p-3">
            <h3>Twoje pożyczki</h3>
            <hr />
            <p class="ml-3"> Brak pożyczek </p>
            </div>
            <div class="col-md-12 bg-white shadow p-3 mt-3">
            <h3>Utwórz zgłoszenie</h3>
            <hr />
            <form method="POST" action="/report">
            <div class="col-12 mt-4">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Temat">
            </div>
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Opis"></textarea>
            </div>

            <button type="submit" class="btn btn-primary d-block mx-auto px-4">Wyślij</button>
            </div>
            </form>
            </div>
        </div>
        
    </div>
    


</div>
    