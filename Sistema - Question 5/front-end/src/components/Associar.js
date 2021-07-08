import React, { useEffect, useState } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6';
import api from '../api/api';

export default function Associar(props) {
  
  const [arrClube, setArrClube] = useState([])
  const [bool, setBool] = useState(false)
  const socio = props.socio;

  let history = useHistory();

  const [clubeid, setClubeID] = useState()

  let cookie = new Cookies();
  let data = cookie.get('data')
  let user_id;
  if (!data || data.length === 0) {
    history.push('/logout')
  } else {
    user_id = data.uid;
  }

  useEffect(()=>{
    api().get('sanctum/csrf-cookie').then((res) => {
      api().post('/api/clubes', { uid: user_id })
        .then((res) => { setArrClube(res.data.clubes) })
        .catch((e) => { if (e.response) console.log(e.response.error) })
    });
  }, [])

  useEffect(()=>{
    if (arrClube.length > 0) setBool(true)
  }, [arrClube])

  const associate = (e = false) => {
    if (e) e.preventDefault();

    api().get('sanctum/csrf-cookie').then((res) => {
      api().post('/api/socios/associar', { uid: user_id, socio_id: socio.id, clube_id: clubeid})
        .then((res) => { 
          props.atualizar()
          props.associar() 
        })
        .catch((e) => { if (e.response) console.log(e.response.error) })
    });

  }

  return (
    <div>
      <form onSubmit={(e) => { associate(e) }}>
        <select onChange={(e)=>{setClubeID(e.target.value)}} className='form-select btn__form' disabled={!bool}>
          {bool && arrClube.map((el) => {
            return (
              <option value={el.id} key={el.id}> {el.name} </option>
            )
          })}
          {arrClube.length == 0 && (
            <option selected>Carregando...</option>
          )}
        </select>
      </form>
      <hr />
      <div className='d-flex justify-content-evenly'>
        <button onClick={() => { associate() }} className="btn btn-success w-50 mx-1 p-2">Confirmar</button>
        <button onClick={() => { props.associar() }} className="btn btn-danger w-50 mx-1 p-2">Cancelar</button>
      </div>
    </div>
  )
}
