/**get all names from src/public/img/heads/winners.json */
fetch('src/public/img/buildbattles/winners.json')
  .then(response => response.json())
  .then(data => {
    /**loop thru entire list and show the theme, name and a head corresponding to the name from /heads with another div around it*/
    for (let i = 0; i < data.length; i++) {
      let div = document.createElement('div');
      div.className = 'winner';
      div.innerHTML = `<div><h4>${data[i].name}</h4><img src="src/public/img/heads/${data[i].name}.png" alt="${data[i].name}"></div><h3>${data[i].theme}</h3>`;
      document.querySelector('#winner-swapper').appendChild(div);
      /**give background-image buidbattle + array number */
      div.style.backgroundImage = `url('src/public/img/buildbattles/buildbattle_${i + 1}.webp')`;
    }
  })
  .catch(error => console.error(error));