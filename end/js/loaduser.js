
const loaduser = () => {


    const name = document.getElementById("inputname");
    name.value = "";
    const x = document.getElementById("namec").value;
    const y = document.getElementById("address").value;
    const z = document.getElementById("phone").value;
    const id = document.getElementById("uid").value;
    // const btn = document.getElementById("save");
    // console.log(x,y,z, id);
    // console.log(Date.now());
    
    let today = new Date();
    let month = today.getMonth()+1;
    let year = today.getFullYear();
    let date = today.getDate();
    let tm = gettime();
    console.log(tm);
    let fd = year+"-"+month+"-"+date;
    fd = fd.toString();
    // console.log(typeof(fd));	

    const product1 = document.getElementById("namegiven");
    // console.log(product1);
    const qty = document.getElementById("productqty").value;
    const product = document.getElementById("checkproductname");
    const product_content = product.innerText;
    const mrp = document.getElementById("mrp");
    const mrpvalue = mrp.innerText;
    const buy = document.getElementById("buy");
    const buy_content = buy.innerText;
    const sell = document.getElementById("sell");
    const sell_content = sell.innerText;
    const final = document.getElementById("sellyou").value;
    const profit = (final - buy_content);
    const total_profit = profit * qty;
    const total = (final*qty);
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
        <td class="fw-bold ">${final}</td>
       
        
        <td class="fw-bold totaltk ">${total}</td>    
        <td class="fw-bold  ">${date}/${month}/${year}</td> 
        
        

    `
    // <h5 class="fw-bold  text-center"><button class="btn btn-primary"  onclick="dltrow(${refid}, ${product_content})">Delete </button> 
    // </h5>
    
    const b1 = document.createElement("button");
    b1.classList.add("btn"  ,"btn-primary", "dltbtn");
    b1.type = "button";
    b1.innerText = "Delete";
    b1.addEventListener("click", () => dltrow(gg.id, product_content, fd, qty, id));
    gg.appendChild(b1);
    

    div1.appendChild(gg);
    
    var xmlhttp = new XMLHttpRequest();
             
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById("recipt2").innerHTML = this.responseText;
    }
    };
    xmlhttp.open("GET","adjust.php?q="+qty+"&p="+product_content,true);
    xmlhttp.send();


    
    var xmlhttp = new XMLHttpRequest();
                
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById(`${product_content}`).innerHTML = this.responseText; 
        // console.log(this.responseText);
    }
    };
    xmlhttp.open("GET","invoice2.php?id="+id+"&cn="+x+"&phn="+z+"&d="+fd+"&t="+tm+"&pro="+product_content+"&q="+qty+"&tot="+total,true);
    xmlhttp.send();
    
    

     
    
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
