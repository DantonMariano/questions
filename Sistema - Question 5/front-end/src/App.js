import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Navbar from "./components/Navbar";
//css
import './styles/styles.css';


//Components
import Logout from "./components/Logout";
import Cookies from "universal-cookie/es6";
//Pages
import Login from "./pages/Login";
import Register from "./pages/Register";
import { useState } from "react";
import HomePage from "./pages/HomePage";
import Clubes from "./pages/Clubes";
import Socios from "./pages/Socios";
//Router

function App() {


  //cookie
  let cookie = new Cookies();
  let data = cookie.get('data');

  //session handling
  const [isLogged, setIsLogged] = useState(data ? true : false);
  const loggedIn = (e) => {
    if (e) setIsLogged(true)
  }
  const logOut = (e) => {
    if (e) setIsLogged(false)
  }

  return (
    <Router>
      <div>
        <Navbar isLogged={isLogged} />
        <div className='container p-5'>
          <Switch>
            <Route exact path="/login">
              <Login logged={(e) => { loggedIn(e) }} />
            </Route>
            <Route exact path="/register">
              <Register />
            </Route>
            <Route exact path="/logout">
              <Logout logout={(e) => { logOut(e) }} />
            </Route>
            <Route exact path="/">
              <HomePage isLogged={isLogged} />
            </Route>
            <Route exact path='/clubes'>
              <Clubes isLogged={isLogged} />
            </Route>
            <Route exact path='/socios'>
              <Socios isLogged={isLogged} />
            </Route>
          </Switch>
        </div>
      </div>
    </Router>
  );
}

export default App;
