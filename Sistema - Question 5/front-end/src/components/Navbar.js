import React from 'react'
import { Link } from 'react-router-dom'

export default function Navbar(props) {

  return (
    <nav className="navbar navbar-light d-flex bg-primary">
      <div className='justify-content-begin'>
        <Link to="/">
          <h1 className='mx-5 bg-secondary'> Clubes.com </h1>
        </Link>
      </div>
      <div className='justify-content-end'>
        {!props.isLogged && (
          <>
            <h3 className='mx-5 bg-secondary'>
              <Link to="/login">Login</Link>
            </h3>
            <h3 className='mx-5 bg-secondary'>
              <Link to="/register">Register</Link>
            </h3>
          </>
        )}
        {props.isLogged && (
          <>
            <h3 className='mx-5 bg-secondary'>
              <Link to="/clubes">Clubes</Link>
            </h3>
            <h3 className='mx-5 bg-secondary'>
              <Link to="/socios">Socios</Link>
            </h3>
            <h3 className='mx-5 bg-secondary'>
              <Link to="/logout">Sair</Link>
            </h3>
          </>
        )}
      </div>
    </nav>
  )
}
