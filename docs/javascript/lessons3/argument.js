function hello(){
    console.log('Szia');
}

hello();
hello(123);
hello(123,222,'asds');

function printArguments(a, b, c){
    console.log(a);
    console.log(b);
    console.log(c);    
}

printArguments();

function printArguments2(){
    // arguments egy tömb
    console.log(arguments);    
}

printArguments2(1,66,'a');

function printArguments3(...arg){
    // arguments egy tömb
    console.log(arg);    
}

printArguments3(1,6,3);