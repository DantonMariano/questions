/** FizzBuzz Function
 * 
 * @param {number} max 
 * @returns FizzBuzz de 1 até max
 */
const fizzbuzz = (max) => {
  let array = []
  for (let i = 1; i <= max; i++) {
    if (i % 5 !== 0 && i % 3 !== 0) array.push(i)
    if (i % 5 === 0 && i % 3 === 0) array.push('FizzBuzz')
    if (i % 5 === 0 && i % 3 !== 0) array.push('Buzz')
    if (i % 5 !== 0 && i % 3 === 0) array.push('Fizz')
  }
  return array;
}

//Array com FizzBuzz até 100
const fbarray = fizzbuzz(100)

//HTML
const list = document.getElementById('fizzbuzz')
const li = document.createElement("li")

//Listagem do Array
fbarray.map((el) => {
  if (typeof el === 'number') list.innerHTML += `<li class="list-group-item">${el}</li>`
  if (el === 'Fizz') list.innerHTML += `<li class="list-group-item list-group-item-success">${el}</li>`
  if (el === 'Buzz') list.innerHTML += `<li class="list-group-item list-group-item-danger">${el}</li>`
  if (el === 'FizzBuzz') list.innerHTML += `<li class="list-group-item list-group-item-primary">${el}</li>`
})