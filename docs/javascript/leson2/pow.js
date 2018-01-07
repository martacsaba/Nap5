function pow(number, exponent){
    var output = 0;
    if (exponent === 0){
        output = 1;
    }else if (exponent === 1){
        output = number;              
    }else if (exponent > 1){
        output = number;
        for (var idx = 0; idx < (exponent-1); idx++) {
            output *= number;
        }
    }
    
    return output;
}

console.log(pow(2,0));
console.log(pow(2,1));
console.log(pow(2,2));
console.log(pow(2,3));
console.log(pow(2,4));
console.log(pow(2,5));
console.log(pow(2,8));
console.log(pow(2,32));