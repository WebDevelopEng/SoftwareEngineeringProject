function addquantity(){
    var $inputvalue=document.getElementById('quantity');
    $inputvalue.value=Number($inputvalue.value)+1;
    var $totalcost=document.getElementById('totalcost');
    var $productprice=document.getElementById('productprice');
    $totalcost.innerHTML=Number($productprice.innerHTML) * Number($inputvalue.value);
}
function decreasequantity(){
    var $inputvalue=document.getElementById('quantity');
    if(Number($inputvalue.value)>1){
    $inputvalue.value=Number($inputvalue.value)-1;
    var $totalcost=document.getElementById('totalcost');
    var $productprice=document.getElementById('productprice');
    $totalcost.innerHTML=Number($productprice.innerHTML) * Number($inputvalue.value);
    }
}