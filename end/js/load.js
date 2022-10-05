const loadjs = () => {

    const resqty = document.getElementById("productqty").value;
    const resprice = document.getElementById("sellyou").value;
    console.log(resqty, resprice);
    if(resqty == "" || resprice == ""){
       alert("Please select quantity and price");
    }
    else{

    
    
    const name = document.getElementById("inputname");
    name.value = "";
    const x = document.getElementById("namec").value;
    console.log(x);
    const y = document.getElementById("address").value;
    const z = document.getElementById("phone").value;
    const id = document.getElementById("uid").value;
    // const btn = document.getElementById("save");
    // console.log(x,y,z, id);
    // console.log(Date.now());
    if(x != ""){

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
    
    let tm = gettime();
    // console.log(tm);
    // console.log(name);
    let fd = year+"-"+month+"-"+date;
    fd = fd.toString();
    // console.log(typeof(fd));	

    const product1 = document.getElementById("namegiven");
    // console.log(product1);
    const qty = document.getElementById("productqty").value;
    const product = document.getElementById("checkproductname");
    const product_content = product.innerText;
    const company = document.getElementById("productcompany");
    const company_content = company.innerText;
    const mrp = document.getElementById("mrp");
    const mrpvalue = mrp.innerText;
    const buy = document.getElementById("buy");
    const buy_content = buy.innerText;
    const sell = document.getElementById("sell");
    const sell_content = sell.innerText;
    const final = document.getElementById("sellyou").value;
    const final_sell = final/qty;
    const profit = (final_sell - buy_content);
    const total_profit = profit * qty;
    const total = final_sell*qty;

    // const rowid = product_content+"_"+qty;
    // console.log(rowid);
    // console.log(qty+" "+mrpvalue+" "+ buy_content+" "+ sell_content+" "+final);
    const div1 = document.getElementById("recipt");
    let gg = document.createElement("tr");
    // gg.classList.add("d-flex");
    // gg.classList.add("p-3");
    // refid =  gg.id = product_content;
    refid = product_content+"_"+"sss2";
    gg.id = refid;
    gg.classList.add("table-bordered", "mt-2");
    gg.classList.add("billing-list");
    // gg.style.justifyContent="space-between";
    let pro_id = 0;
    
   
    gg.innerHTML = `
        <td  class="fw-bold mt-4">${product_content}</td>
        <td  class="fw-bold " id="${product_content}"></td>
        <td class="fw-bold ">${qty}</td>
        <td class="fw-bold ">${company_content}</td>
        <td class="fw-bold ">${final_sell}</td>
        <td class="fw-bold ">${profit}</td>
        <td class="fw-bold ">${total_profit}</td>
        
        <td class="fw-bold totaltk ">${total}</td>    
        <td class="fw-bold  ">${date}/${month}/${year}</td> 
        
        

    `
    // <h5 class="fw-bold  text-center"><button class="btn btn-primary"  onclick="dltrow(${refid}, ${product_content})">Delete </button> 
    // </h5>
    
    const b1 = document.createElement("button");
    b1.classList.add("btn"  ,"btn-primary", "dltbtn");
    b1.type = "button";
    b1.innerText = "Delete";
    b1.addEventListener("click", () => dltrow(gg.id, product_content, company_content, final_sell,  fd, qty, id, total,total_profit));
    gg.appendChild(b1);
    

    div1.appendChild(gg);
    
    let billtotal = document.getElementById("total_bill").innerHTML;
    let profitshow = document.getElementById("add_profit").innerHTML;
    billtotal = parseFloat(billtotal);
    profitshow = parseFloat(profitshow);
    // console.log(billtotal+4);
    if(isNaN(billtotal)){
        billtotal = 0;
        profitshow = 0;
    }
    billtotal = parseFloat(billtotal);
    profitshow = parseFloat(profitshow);
    
    var xmlhttp = new XMLHttpRequest();
             
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById("recipt2").innerHTML = this.responseText;
        console.log(this.responseText);
    }
    };
    xmlhttp.open("GET","adjust.php?q="+qty+"&p="+product_content+"&totalp="+total_profit,true);
    xmlhttp.send();


    
    var xmlhttp = new XMLHttpRequest();
                
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById(`${product_content}`).innerHTML = this.responseText; 
        console.log(this.responseText);
    }
    };
    xmlhttp.open("GET","invoice2.php?id="+id+"&cn="+x+"&phn="+z+"&d="+fd+"&t="+tm+"&pro="+product_content+"&q="+qty+"&com="+company_content+"&tot="+total+"&mname="+name+"&yname="+year+"&totalp="+total_profit,true);
    xmlhttp.send();
    
    // var xmlhttp2 = new XMLHttpRequest();
                
    // xmlhttp2.onreadystatechange = function() {
    // if (this.readyState == 4 && this.status == 200) {
        
    //     // document.getElementById(`${product_content}`).innerHTML = this.responseText; 
    //     console.log(this.responseText);
    // }
    // };
    // console.log('here');
    // xmlhttp2.open("GET","companybuying.php?compname="+company_content+"&qty="+qty+"&bprice="+buy_content,true);
    // xmlhttp2.send();

    document.getElementById("total_bill").innerHTML = billtotal+total;
    document.getElementById("add_profit").innerHTML = profitshow+total_profit;

    // var xmlhttp = new XMLHttpRequest();
             
    // xmlhttp.onreadystatechange = function() {
    // if (this.readyState == 4 && this.status == 200) {
        
    //     document.getElementById("total_bill").innerHTML = this.responseText;
    // }
    // };
    // xmlhttp.open("GET","total.php?q="+qty+"&p="+product_content+"&tot="+billtotal,true);
    // xmlhttp.send();

    }
    else{
        errorMessage();
    }
    
    

} 
    
}

const gettime = () =>{
    let today = new Date();
    let hr = today.getHours();
    let mn = today.getMinutes();
    let sc = today.getSeconds();
    let time = (hr+":"+mn+":"+sc);
    tm = time.toString();
    return tm;
}

function errorMessage() {
    var error = document.getElementById("error")

          
        // Changing content and color of content
        error.textContent = "Please enter a name"
        error.style.color = "red"
    
}