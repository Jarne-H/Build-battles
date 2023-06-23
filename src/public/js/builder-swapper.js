fetch('src/public/img/heads/builderlist.json')
  .then(response => response.json())
  .then(data => {
    console.log(data);
    /**loop through all objects */
    for (let i = 0; i < data.length; i++) {
        /**object contains name and role */
        let name = data[i].name;
        let role = data[i].role;
        /**create a div with an img h2 and p */
        let div = document.createElement('div');
        let img = document.createElement('img');
        let h2 = document.createElement('h2');
        let p = document.createElement('p');
        /**set the img src to src/public/img/heads/' + file + '.png" alt="' + file + ' */
        img.setAttribute('src', 'src/public/img/heads/' + name + '.png');
        img.setAttribute('alt', name);
        /**set the h2 to the name */
        h2.innerHTML = name;
        /**set the p to the role */
        p.innerHTML = role;
        /**append the img h2 and p to the div */
        div.appendChild(img);
        div.appendChild(h2);
        div.appendChild(p);
        /**append the div to the builder-swapper */
        document.getElementById('builder-swapper').appendChild(div);
        
        
    }
  })
  .catch(error => {
    console.log('Error:', error);
  });
