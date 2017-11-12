<h1>Flight # {id}</h1>
<div class="container-fluid">
<form role="form" action="/Flights/submit" method="post">
<table class="edit">
    <tr>
        <td>{fairplanes}</td>
    </tr>
        <td>{fdepart_airport}</td>
        <td>{fdepart_time}</td>
    </tr>
    <tr>
        <td>{farrive_airport}</td>
        <td>{farrive_time}</td>
    </tr>
    <tr>
        <td>{zsubmit}</td>
    </tr>
</table>
</form>
    {error}
    <a href="/Flights/cancel"><input type="button" value="Cancel"/></a>
    <a href="/Flights/delete"><input type="button" value="Delete"/></a>
</div>