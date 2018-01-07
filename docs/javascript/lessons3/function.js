function concatArray(a, b ){
    for (var i=0 ; i< b.length; i++ ){
        a[a.length] = b[i];
    }
    return a;
}

var result = concatArray([10,20,30],[2,3,5,6,7]);
console.log(result);
