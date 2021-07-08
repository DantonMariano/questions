import React, { useState } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6';
import api from '../api/api';


export default function Login(props) {

  let [user, setUser] = useState('');
  let [pass, setPass] = useState('');
  let history = useHistory();
  const cookie = new Cookies();
  const [error, setError] = useState(false); 
  //
  let isLogged = cookie.get('data') ? true : false;
  if (isLogged) history.push('/')
  //
  const login_user = (e) => {
    e.preventDefault();
    setError(false);
    const body = {
      username: user,
      password: pass
    }
    api().get('sanctum/csrf-cookie').then(response => {
      api().post('api/user/login', body)
        .then((res) => {
          cookie.set('data', { uid: res.data.user_data.id, username: res.data.user_data.username }, { path: '/', maxAge: 600, sameSite: 'lax' })
          props.logged(true);
          history.push('/');
        })
        .catch((e) => {
          if (e.response) setError(e.response.data.error)
        });
    });
  }

  return (
    <div>
      <form onSubmit={(e)=>{login_user(e)}}>
        <div className="mb-3">
          <label className="form-label">Usuário</label>
          <input type="text" onChange={(e) => { setUser(e.target.value) }} className="form-control" id="user" aria-describedby="emailHelp" />
        </div>
        <div className="mb-3">
          <label className="form-label">Senha</label>
          <input type="password" onChange={(e) => { setPass(e.target.value) }} className="form-control" id="password" />
        </div>
        {error && (
          <div className='text-danger my-2'>
            {error}
          </div>
        )}
        <button type="submit" className="btn btn-primary btn__form">Entrar</button>
      </form>
    </div>
  )
}
