import logo from './logo.svg';
import {useEffect, useState} from "react"
import './App.css';
import axios from "axios"

function App() {
const [selectedId,setSelectedId]=useState()
const [gonder,setGonder]=useState("Gönder")
const [value,setValue]=useState();
const [formValue,setFormValue]=useState({
  title:"",
  content:"",
   type:""
 })

const baglan=async () =>{
  const data=await fetch("http://localhost/phpnotes/jsReading.php");
  const result=await data.json()
  console.log(result)
 setValue(result)
}

useEffect(()=>{
  baglan()
},[formValue])


const updating=(id,title,content,type)=>{
  setFormValue({
    title:title,
    content:content,
    type:type
  })
  setGonder("Güncelle")
setSelectedId(id)
   }
  

const sendingData= (e) =>{

e.preventDefault()
let baslik=e.target.title.value
let aciklama=e.target.content.value
let tip=e.target.type.value

if (gonder=="Gönder"){
  const obj = {
    baslik:baslik,
    aciklama:aciklama,
    tip:tip
    }
const config={
  headers:{"Content-Type":"application/x-www-form-urlencoded"}
}
axios.post("http://localhost:80/phpnotes/jsInsert.php",obj,config).then(response=>{
  console.log(response)
}).catch(error=>{
  console.log("hata")
})
setFormValue({title:"",content:"",type:""})
setValue(...value,{baslik:baslik,aciklama:aciklama,tip:tip})
  }else{
    console.log(selectedId)
    const myId = {
      baslik:baslik,
      aciklama:aciklama,
      tip:tip,
      id:selectedId
      }
   
    const config={
      headers:{"Content-Type":"application/x-www-form-urlencoded"}
    }
    axios.post("http://localhost:80/phpnotes/jsUpdate.php",myId,config).then(response=>{
      console.log(response)
    }).catch(error=>{
      console.log("hata")
    })
    setFormValue({title:"",content:"",type:""})
    setGonder("Gönder")


  }
}


const deleting= (myId)=>{

 const obj={
   id:myId
 } 
 const config={
  headers:{"Content-Type":"application/x-www-form-urlencoded"}
}
axios.post("http://localhost:80/phpnotes/jsDelete.php",obj,config)

setValue(value.filter(item=>item.id!=myId))

 }





const changingTitle= (e)=>{
  setFormValue({title:e.target.value})
}
const changingContent= (e)=>{
  setFormValue({content:e.target.value})
}
const changingType= (e)=>{
  setFormValue({type:e.target.value})
}





  return (
    <div className="App">
      Hello!
    {value && value.length>0 ? value.map(item=><p key={item["id"]}>{item["baslik"]+" "+item["aciklama"]+" "+item["tip"]}+<button onClick={()=>updating(item["id"],item["baslik"],item["aciklama"],item["tip"])}>Güncelle</button><button  onClick={()=>deleting(item["id"])}>Sil</button></p>):""}

    <form action="" method="post" onSubmit={sendingData}>
Başlık: <input type="text" name="title" value={formValue.title} onChange={changingTitle}></input>
Açıklama: <input type="text" name="content" value={formValue.content} onChange={changingContent}></input>
Tip: <input type="text" name="type" value={formValue.type} onChange={changingType}></input>
<input type="submit" value={gonder} name="sender" ></input>
</form>


    </div>
  );
}

export default App;
