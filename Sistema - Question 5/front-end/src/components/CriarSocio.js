import React, { useState } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6'
import api from '../api/api'

export default function CriarSocio(props) {
  
  const [nome, setNome] = useState('')
  const [error, setError] = useState(false)
  const [success, setSuccess] = useState(false)

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
    setError(false)
    setSuccess(false)
    e.preventDefault();
    let data = {socio_name: nome, uid: user_id};
    api().get('sanctum/csrf-cookie').then(res=>{
      api().post('/api/socios/criar', data)
      .then((res)=>{
        setSuccess(res.data.success)
        props.atualizar();
      })
      .catch((e)=>{
        if (e.response) setError(e.response.data.error)
        console.log(e.response.data.error);
      });
    })
  }

  return (
    <>
      <form className='form-group my-4' onSubmit={(e)=>{cadastra(e)}}>
        <b className='text-danger my-1'>{error}</b>
        <b className='text-success my-1'>{success}</b>
        <input className='form-control h1' placeholder='Crie um novo Sócio!' onChange={(e)=>{setNome(e.target.value)}}></input>
        <br/>
        <button className='btn btn-primary btn__form' type='submit'>Cadastrar</button>
      </form>
    </>
  )
}
