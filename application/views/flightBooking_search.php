
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


<table class="flights-table">
    <tr><th>Departure Airport</th><th>Destination Airport</th></tr>
    {flights}
        <tr>
            <td>{depart_airport}{name}{/depart_airport} - {depart_time}</td>
            <td>{arrive_airport}{name}{/arrive_airport} - {arrive_time}</td>
        </tr>
    {/flights}
</table>
<a href="/flightBooking"><input type="button" value="Back"/></a>

</div>


