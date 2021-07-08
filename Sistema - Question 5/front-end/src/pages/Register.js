import React, { useState } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6';
import api from '../api/api';

export default function Register() {

  let history = useHistory();

  let [user, setUser] = useState('');
  let [pass, setPass] = useState('');
  const [error, setError] = useState(false)
  const [success, setSuccess] = useState(false)

  //
  let cookie = new Cookies();
  let isLogged = cookie.get('data') ? true : false;
  if (isLogged) history.push('/')
  //

  const register_user = (e) => {
    e.preventDefault();
    setError(false);
    setSuccess(false);
    const body = {
      username: user,
      password: pass
    }
    api().get('sanctum/csrf-cookie').then(response => {
      api().post('api/user/register', body)
        .then((res) => {
          setSuccess(res.data.success)
          setTimeout(() => {
            history.push('/login')
          }, 1000);
        })
        .catch((e) => {
          if (e.response) setError(e.response.data.error)
        });
    });
  }

  return (
    <div>
      <form onSubmit={(e)=>{register_user(e)}}>
        <div className="mb-3">
          <label className="form-label">Usuário</label>
          <input type="text" onChange={(e) => { setUser(e.target.value) }} className="form-control" id="name" aria-describedby="emailHelp" />
        </div>
        <div className="mb-3">
          <label className="form-label">Senha</label>
          <input type="password" onChange={(e) => { setPass(e.target.value) }} className="form-control" id="pass" />
          <div id="emailHelp" className="form-text">Lembre-se de sempre criar uma senha segura.</div>
        </div>
        {error && (
          <div className='text-danger my-2'>
            {error}
          </div>
        )}
        {success && (
          <div className='text-success my-2'>
            {success}
          </div>
        )}
        <button type="submit" className="btn btn-primary btn__form">Registrar</button>
      </form>
    </div>
  )
}
