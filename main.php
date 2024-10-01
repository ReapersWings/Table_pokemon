<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="display">

    </div>
</body>
</html>
<script>
    
    fetch("https://pokeapi.co/api/v2/pokemon?limit=100&amp;offset=0")
    .then(respone=>{
        if (!respone.ok) {
            throw new Error('Network respone was not ok');
        }
        return respone.json();
    })
    .then(data =>{
        let pokemons = data.results;
        let displayplease =document.getElementById('display')
        pokemons.forEach(pokemen => {
            fetch(pokemen.url)
            .then(respone=>{
                if (!respone.ok) {
                    throw new Error('Network respone was not ok');
                }
                return respone.json();
            })
            .then(characteristocs=>{
                console.log(characteristocs)
                const para =document.createElement('div')
                para.style.border="1px solid black"
                para.style.padding="5px"
                para.style.borderRadius="5px"
                fetch(characteristocs.species.url)
                .then(respone=>{
                    if (!respone.ok) {
                        throw new Error ('Network respone was not ok');
                    }
                    return respone.json();
                })
                .then(color=>{
                    para.style.backgroundColor=color.color.name;
                })
                const p =document.createElement("p")
                p.innerHTML=pokemen.name ;
                para.appendChild(p);

                const typedisplay =document.createElement("p")
                let countloop = 0
                characteristocs.types.forEach(typestext => {
                    if (countloop === 0 ) {
                        typedisplay.innerHTML+=" Type : "+typestext.type.name;
                    }else{
                        typedisplay.innerHTML+=","+typestext.type.name;
                    }
                    countloop += 1;
                    console.log(countloop)
                    return countloop ;
                });
                para.appendChild(typedisplay);

                const basedata =document.createElement("p")
                basedata.innerHTML="Base Status:" ;
                basedata.setAttribute("style","margin:0px")
                para.appendChild(basedata);

                characteristocs.stats.forEach(basestatusdb =>{
                    const basestatus = document.createElement("p")
                    basestatus.setAttribute("style","margin:0px");
                    basestatus.innerHTML=basestatusdb.stat.name+":"+basestatusdb.base_stat
                    para.appendChild(basestatus);  
                })

                const img = document.createElement("img")
                img.setAttribute("src", characteristocs.sprites.front_default);
                img.width=200;
                img.height=200;
                

                

                para.appendChild(img);
                setTimeout(displayplease.appendChild(para),3000)
                
            })
        }); 
    })
    .catch(error => console.error('Error',error));
</script>
<style>
    #display{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        grid-column-gap: 20px;
        grid-row-gap: 20px;
    }
    img{
        border: 2px solid black;
        margin: 7px;
    }
    p{
        text-align: center;
        border: 2px solid black;
        background-color: black;
        color:white;
    }
</style>