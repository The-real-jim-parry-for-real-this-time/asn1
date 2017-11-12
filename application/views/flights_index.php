
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
<h3>Current Swallow Flights</h3>

<!--    0 => array('code' => IDENTIFIER_CHAR . "001", 'depart_airport' => 0, 'depart_time' => '12:25', 'arrive_airport' => 1, 'arrive_time' => '23:15' )
-->

    <table class="flights-table">
        <tr><th>Flight Code</th><th>Airplane</th><th>Departure</th><th>Arrival</th></tr>
    {flights}
        <tr><td><b>{code}</b></td>
            <td>{airplanes}<a href="/Fleet/{id}" title="${price} Reach: {reach} Seats: {seats} Speed: {cruise} Hourly: ${hourly}">{manufacturer} {model}</a>{/airplanes}</td>
            <td>{depart_airport}<a href="#" title="{name} ({type})">{code}</a>{/depart_airport} {depart_time}</td>
            <td>{arrive_airport}<a href="#" title="{name} ({type})">{code}</a>{/arrive_airport} {arrive_time}</td></tr>
    {/flights}
    </table>


    <!--{flights}
        {code} {depart_airport} -> {arrive_airport}
    {/flights}-->

</div>


