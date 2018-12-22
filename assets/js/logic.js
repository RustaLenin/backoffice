console.log('logic.js loaded...');

export function Debounce( func, delay){
    var lastTimeout;
    return function(){
        if( lastTimeout ) {
            clearTimeout( lastTimeout );
        }
        var args = Array.from( arguments );
        lastTimeout = setTimeout(function(){
            func.apply(null, args);
        }, delay);
    }
}