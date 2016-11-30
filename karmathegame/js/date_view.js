function date_view(id)
{
        date = new Date;
        
        month = date.getMonth();
        months = new Array('Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'June', 'July', 'Aug.', 'Sept.', 'Oct.', 'Nov.', 'Dec.');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
       
        result = ''+days[day]+' '+months[month]+' '+d;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_view("'+id+'");','1000');
        return true;
}