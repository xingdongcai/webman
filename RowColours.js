function altrows(firstcolor,secondcolor)
{
    var tableElements = document.getElementsByTagName("table") ;
    for(var j = 0; j < tableElements.length; j++)
    {
        var table = tableElements[j] ;

        var rows = table.getElementsByTagName("tr") ;
        for(var i = 0; i <= rows.length; i++)
        {
            if(i%2==0){
                rows[i].style.backgroundColor = firstcolor ;
            }
            else{
                rows[i].style.backgroundColor = secondcolor ;
            }
        }
    }
}