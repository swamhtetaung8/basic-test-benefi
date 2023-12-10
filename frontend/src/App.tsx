import "./App.css";
import CalculatorForm from "./components/CalculatorForm";
import Divider from "./components/Divider";
import Sample from "./components/Sample";
const App = () => {
  return (
    <div className="flex flex-col justify-between min-h-screen py-5 ">
      <Divider fieldName="Befeni Basic Test" fontStyle="italic" />
      <div className="flex flex-col justify-between md:items-center md:px-10 md:flex-row">
        <CalculatorForm />
        <Sample />
      </div>
      <Divider fieldName="Swam Htet Aung" fontStyle="normal" />
    </div>
  );
};

export default App;
