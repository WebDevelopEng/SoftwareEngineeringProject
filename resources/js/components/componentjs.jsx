import React from 'react';
import ReactDOM from 'react-dom/client';


function recipecard(){
    let ingredientstring="";
    return(
        <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap"/>
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
    );
}
function searchbar(){
    return(
        <div style="width:60%;margin:auto;">
            <input class="form-control" style="width:70%;" type="text" name="search" id="search"></input>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    )
}