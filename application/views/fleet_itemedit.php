<h1>Plane # {id}</h1>
<form role="form" action="/Fleet/submit" method="post">
    {fmanufacturer}
    {fmodel}
    {fprice}
    {fseats}
    {freach}
    {fcruise}
    {ftakeoff}
    {fhourly}
    {zsubmit}
</form>
    {error}
    <a href="/Fleet/cancel"><input type="button" value="Cancel"/></a>
    <a href="/Fleet/delete"><input type="button" value="Delete"/></a>