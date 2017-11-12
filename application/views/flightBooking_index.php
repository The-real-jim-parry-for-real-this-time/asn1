
<style>
    .flights-table td, .flights-table th {
        padding-right: 20px;
        padding-top: 3px;
        text-align: left;
    }



    .flights-table th {
        border-bottom: 1px solid black
    }

</style>

<div id="body">
<h3>Book With Swallow</h3>

<form role="form" action="/FlightBooking/search" method="POST">
    <table class="flights-table">
        <tr><th>Departure Airport</th><th>Destination Airport</th><th></th></tr>
        <tr><td>{fdepart}</td>
            <td>{fdest}</td>
            <td>{zsubmit}</td></tr>
            <tr><td></td><td>{fdest2}</td></tr>
            <tr><td></td><td>{fdest3}</td></tr>
    </table>
</form>

{error}

</div>


