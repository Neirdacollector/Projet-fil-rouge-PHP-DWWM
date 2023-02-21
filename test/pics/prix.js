const basic = document.querySelector('.basic');
const prof = document.querySelector('.prof');
const master = document.querySelector('.master')
const button = document.getElementById('checkbox');
console.log(button);

// Methode 1 :

// button.addEventListener('click', () =>{
      
// if (button.checked === true) {
//     console.log('true');
   
//     basic.innerText = "200";
//     console.log(basic);
//     prof.innerText = "800";
//     master.innerText = "1500";
// }else {
//     basic.innerText = "9.99";
//     basic.style.color = "red";
//     console.log(basic);
//     prof.innerText = "19.99";
//     prof.style.color = "orange";
//     master.innerText = "29.99";
//     master.style.color = "green";}
// });

// Methode 2 : tableau

// button.addEventListener('click', () =>{
      
// if (button.checked === true) {
//     console.log('true');
//     [basic.innerText , prof.innerText, master.innerText] = [200,800,1500];
    
// }else {
//     [basic.innerText, prof.innerText, master.innerText] = [9.99,19.99,29.99];
//     }
// });

// Methode 3 : ternaire

button.addEventListener('click', () =>{
    basic.innerText = button.checked ? 200 : 9.99
    prof.innerText = button.checked ? 800 : 19.99
    master.innerText = button.checked ? 1500 : 29.99
});



// Methode 4 : 

// const prix = [basic.innerText , prof.innerText, master.innerText];
// let tab = [];

// button.addEventListener('click', () =>{
// if (button.checked) {
//     for (i = 0; i < prix.lenght; i++){
//         prix[i] = prix [i * 12];
//     }
//     [basic.innerText , prof.innerText, master.innerText] = [prix[0], prix[1], prix[3]];
// }else {
//         [basic.innerText, prof.innerText, master.innerText] = [9.99,19.99,29.99];
//         }


// });