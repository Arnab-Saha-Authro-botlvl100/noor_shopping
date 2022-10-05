const movetodatebysearch = () => {
    let today = new Date();
    let month = today.getMonth()+1;
    let date = today.getDate();
    if(month>=1 && month<10){
        month = month.toString();
        month = '0'+month
    }
    if(date>=1 && date<10){
        date = date.toString();
        date = '0'+date;
    }
    console.log(month);
    const monthsname = ["check", "January","February","March","April","May","June","July","August","September","October","November","December"];
    let name = monthsname[today.getMonth()+1];
    let year = today.getFullYear();
    
    
    // console.log(tm);
    // console.log(name);
    let fd = year+"-"+month+"-"+date;
    fd = fd.toString();
    window.location.href = `datebysearch.php?search=${fd}`;
}