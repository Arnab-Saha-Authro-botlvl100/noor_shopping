const dlt = function (name){
    const value = name;
    var mysql = require('mysql');

    var con = mysql.createConnection({
    host: "localhost",
    user: "aurexaac_buja",
    password: "bu!ja4#20,38?kd",
    database: "aurexaac_anan"
    });

    con.connect(function(err) {
    if (err) throw err;
    var sql = "DELETE FROM product WHERE product_name = '${name}'";
    con.query(sql, function (err, result) {
        if (err) throw err;
        console.log("Number of records deleted: " + result.affectedRows);
    });
    });
}