import React, { useEffect, useState } from 'react'
import { useHistory } from 'react-router'
import Cookies from 'universal-cookie/es6';
import api from '../api/api';
import CriarSocio from '../components/CriarSocio';
import SocioCards from '../components/SocioCards';


export default function Socios(props) {
  let history = useHistory();
  if (!props.isLogged) history.push('/logout')
  let cookie = new Cookies();
  let data = cookie.get('data')
  let user_id;
  if (!data || data.length === 0) {
    history.push('/logout')
  } else {
    user_id = data.uid;
  }

  const [socios, setSocios] = useState([])
  const [isLoading, setIsLoading] = useState(false)

  const atualiza = () => {
    setIsLoading(true)
    api().get('sanctum/csrf-cookie').then((res) => {
      api().post('/api/socios', { uid: user_id })
        .then((res) => {
          setSocios(res.data)
          setIsLoading(false)
        })
        .catch((e) => { if (e.response) console.log(e.response.error) })
    });
  }

  useEffect(() => {
    atualiza()
  }, [])

  return (
    <>
      <h1 align='center'>
        Socios
        {isLoading && (
          <div className="spinner-border mx-3 align-center"></div>
        )}
      </h1>
      <div className='d-flex align-content-start justify-content-between flex-wrap'>
        <SocioCards socios={socios} atualizar={() => { atualiza() }} isLoading={isLoading} />
      </div>
      <br />
      <hr />
      <CriarSocio atualizar={() => { atualiza() }} />
    </>
  )
}
