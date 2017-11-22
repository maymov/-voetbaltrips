<li {!! (Request::is('admin/competition_seatings') || Request::is('admin/competition_seatings/create') || Request::is('admin/competition_seatings/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-ticket fa-lg"></i>
        <span class="title">Tickets</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/competition_seatings') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/competition_seatings') }}">
                <i class="fa fa-angle-double-right"></i>
                Tickets
            </a>
        </li>
        <li {!! (Request::is('admin/competition_seatings/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/competition_seatings/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New ticket
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/matches') || Request::is('admin/matches/create') || Request::is('admin/matches/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-soccer-ball-o fa-lg"></i>
        <span class="title">Matches</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/matches') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/matches') }}">
                <i class="fa fa-angle-double-right"></i>
                Matches
            </a>
        </li>
        <li {!! (Request::is('admin/matches/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/matches/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Match
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/flights') || Request::is('admin/flights/create') || Request::is('admin/flights/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-plane fa-lg"></i>
        <span class="title">Flights</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/flights') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/flights') }}">
                <i class="fa fa-angle-double-right"></i>
                Flights
            </a>
        </li>
        <li {!! (Request::is('admin/flights/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/flights/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Flight
            </a>
        </li>
        <li {!! (Request::is('admin/flights/log') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/flights/log') }}">
                <i class="fa fa-angle-double-right"></i>
                Log
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/accomodations') || Request::is('admin/accomodations/create') || Request::is('admin/accomodations/*') || Request::is('admin/hotel-options/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-hotel fa-lg"></i>
        <span class="title">Accomodations</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/accomodations') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/accomodations') }}">
                <i class="fa fa-angle-double-right"></i>
                Accomodations
            </a>
        </li>
        <li {!! (Request::is('admin/accomodations/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/accomodations/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Accomodation
            </a>
        </li>
        <li {!! (Request::is('admin/hotel-options') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/hotel-options') }}">
                <i class="fa fa-angle-double-right"></i>
                Hotel-options
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/clubs') || Request::is('admin/clubs/create') || Request::is('admin/clubs/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-group fa-lg"></i>
        <span class="title">Clubs</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/clubs') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/clubs') }}">
                <i class="fa fa-angle-double-right"></i>
                Clubs
            </a>
        </li>
        <li {!! (Request::is('admin/clubs/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/clubs/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Club
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/stadia') || Request::is('admin/stadia/create') || Request::is('admin/stadia/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-home fa-lg"></i>
        <span class="title">Stadium</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/stadia') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/stadia') }}">
                <i class="fa fa-angle-double-right"></i>
                Stadium
            </a>
        </li>
        <li {!! (Request::is('admin/stadia/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/stadia/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Stadium
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/tournaments') || Request::is('admin/tournaments/create') || Request::is('admin/tournaments/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-trophy fa-lg"></i>
        <span class="title">Tournaments</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/tournaments') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/tournaments') }}">
                <i class="fa fa-angle-double-right"></i>
                Tournaments
            </a>
        </li>
        <li {!! (Request::is('admin/tournaments/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/tournaments/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Tournament
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/invoices') || Request::is('admin/invoices/create') || Request::is('admin/invoices/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-money fa-lg"></i>
        <span class="title">Financial</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/invoices') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/invoices') }}">
                <i class="fa fa-angle-double-right"></i>
                Invoices
            </a>
        </li>
        <li {!! (Request::is('admin/invoices/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/invoices/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Invoice
            </a>
        </li>
        <li {!! (Request::is('admin/invoice_lines') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/invoice_lines') }}">
                <i class="fa fa-angle-double-right"></i>
                Invoice lines
            </a>
        </li>
        <li {!! (Request::is('admin/invoice_lines/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/invoice_lines/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Invoice line
            </a>
        </li>

        <li {!! (Request::is('admin/payments') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/payments') }}">
                <i class="fa fa-angle-double-right"></i>
                Payments
            </a>
        </li>
        <li {!! (Request::is('admin/payments/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/payments/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Payment
            </a>
        </li>

    </ul>
</li>

<li {!! (Request::is('admin/mails') || Request::is('admin/mails/create') || Request::is('admin/mails/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-envelope-o"></i>
        <span class="title">Mails</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/mails') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/mails') }}">
                <i class="fa fa-angle-double-right"></i>
                Mails
            </a>
        </li>
        <li {!! (Request::is('admin/mails/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/mails/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Mail text
            </a>
        </li>
    </ul>
</li>



<li {!! (Request::is('admin/languages') || Request::is('admin/languages/create') || Request::is('admin/language-keys') || Request::is('admin/language-keys/*') || Request::is('admin/languages/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="fa fa-language fa-lg"></i>
        <span class="title">Languages</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/languages') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/languages') }}">
                <i class="fa fa-angle-double-right"></i>
                My Languages
            </a>
        </li>
        <li {!! (Request::is('admin/language-keys') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/language-keys') }}">
                <i class="fa fa-angle-double-right"></i>
                Language keys
            </a>
        </li>
        <li {!! (Request::is('admin/languages/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/languages/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Language
            </a>
        </li>
    </ul>
</li>







@if(Sentinel::getUser()->inRole('superadmin'))

    <li {!! (Request::is('admin/invoice_lines') || Request::is('admin/invoice_lines/create') || Request::is('admin/invoice_lines/*') ? 'class="active"' : '') !!}>
    <a href="#">
    <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
    <span class="title">Invoice lines</span>
    <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
    <li {!! (Request::is('admin/invoice_lines') ? 'class="active" id="active"' : '') !!}>
    <a href="{{ URL::to('admin/invoice_lines') }}">
    <i class="fa fa-angle-double-right"></i>
    Invoice lines
    </a>
    </li>
    <li {!! (Request::is('admin/invoice_lines/create') ? 'class="active" id="active"' : '') !!}>
    <a href="{{ URL::to('admin/invoice_lines/create') }}">
    <i class="fa fa-angle-double-right"></i>
    Add New Invoice line
    </a>
    </li>
    </ul>
    </li>

@endif








<li {!! (Request::is('admin/airportlists') || Request::is('admin/airportlists/create') || Request::is('admin/airportlists/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Airportlists</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/airportlists') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/airportlists') }}">
                <i class="fa fa-angle-double-right"></i>
                Airportlists
            </a>
        </li>
        <li {!! (Request::is('admin/airportlists/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/airportlists/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Airportlist
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/airport_cities') || Request::is('admin/airport_cities/create') || Request::is('admin/airport_cities/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Airport_cities</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/airport_cities') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/airport_cities') }}">
                <i class="fa fa-angle-double-right"></i>
                Airport_cities
            </a>
        </li>
        <li {!! (Request::is('admin/airport_cities/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/airport_cities/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Airport_city
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/orders') || Request::is('admin/orders/create') || Request::is('admin/orders/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Orders</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/orders') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/orders') }}">
                <i class="fa fa-angle-double-right"></i>
                Orders
            </a>
        </li>
        <li {!! (Request::is('admin/orders/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/orders/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Order
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/countries') || Request::is('admin/countries/create') || Request::is('admin/countries/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Countries</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/countries') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/countries') }}">
                <i class="fa fa-angle-double-right"></i>
                Countries
            </a>
        </li>
        <li {!! (Request::is('admin/countries/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/countries/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Country
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/cities') || Request::is('admin/cities/create') || Request::is('admin/cities/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Cities</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/cities') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/cities') }}">
                <i class="fa fa-angle-double-right"></i>
                Cities
            </a>
        </li>
        <li {!! (Request::is('admin/cities/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/cities/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New City
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/seatingcategories') || Request::is('admin/seatingcategories/create') || Request::is('admin/seatingcategories/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Seatingcategories</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/seatingcategories') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/seatingcategories') }}">
                <i class="fa fa-angle-double-right"></i>
                Seatingcategories
            </a>
        </li>
        <li {!! (Request::is('admin/seatingcategories/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/seatingcategories/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Seatingcategory
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/orders_statuses') || Request::is('admin/orders_statuses/create') || Request::is('admin/orders_statuses/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Order Status Config</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/orders_statuses') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/orders_statuses') }}">
                <i class="fa fa-angle-double-right"></i>
                Order Status
            </a>
        </li>
        <li {!! (Request::is('admin/orders_statuses/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/orders_statuses/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Order Status
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/options') || Request::is('admin/options/create') || Request::is('admin/options/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Options</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/options') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/options') }}">
                <i class="fa fa-angle-double-right"></i>
                Options
            </a>
        </li>
        <li {!! (Request::is('admin/options/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/options/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Option
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/settings') || Request::is('admin/settings/create') || Request::is('admin/settings/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Settings</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/settings') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/settings') }}">
                <i class="fa fa-angle-double-right"></i>
                Settings
            </a>
        </li>
        <li {!! (Request::is('admin/settings/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/settings/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Setting
            </a>
        </li>
    </ul>
</li>