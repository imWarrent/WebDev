import logo from './logo.svg';
import './App.css';
import NavBarComp from './components/navBar'

function App() {
  return (
    <div className="App">
      <div className="App">
          <NavBarComp/>
        </div>
    </div>
  );
}
if(window.location.pathname == '/'){
  window.location.replace('/Home');
}
export default App;
