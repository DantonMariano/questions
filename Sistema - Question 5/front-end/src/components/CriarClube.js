import React, { useState } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6'
import api from '../api/api'

export default function CriarClube(props) {
  
  const [nome, setNome] = useState('')

  let history = useHistory();

  let cookie = new Cookies();
  let user_id;
  let data = cookie.get('data');
  if (!data || data.length === 0) {
    history.push('/logout');
  } else { 
    user_id = data.uid;
  }
  const cadastra = (e) => {
    e.preventDefault();
    let data = {clube_name: nome, uid: user_id};
    api().get('sanctum/csrf-cookie').then(res=>{
      api().post('/api/clubes/criar', data)
      .then((res)=>{
        console.log(res.data);
        props.update();
      })
      .catch(e=>console.log(e));
    })
  }

  return (
    <>
      <form className='form-group' onSubmit={(e)=>{cadastra(e)}}>
        <input className='form-control h1' placeholder='Crie um novo Clube!' onChange={(e)=>{setNome(e.target.value)}}></input>
        <br/>
        <button className='btn btn-primary btn__form' type='submit'>Cadastrar</button>
      </form>
    </>
  )
}
