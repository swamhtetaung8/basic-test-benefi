import { ResponseObject } from "./CalculatorForm";

type ResultProps = {
  result: ResponseObject;
  setOpenModal: (boolean: boolean) => void;
};

const Result = ({ result, setOpenModal }: ResultProps) => {
  const closeModal = () => {
    setOpenModal(false);
  };
  return (
    <div
      data-testid="result-component"
      className="absolute top-0 left-0 flex items-center justify-center w-screen h-screen">
      <div className="absolute z-10 w-full h-full bg-black/20"></div>
      <div className="relative z-20 p-5 m-5 md:m-0 md:p-10 space-y-5 bg-white rounded-md shadow-md md:min-w-[300px]">
        {result?.message && (
          <p className="text-red-500 ">Error - {result?.message}</p>
        )}
        {result?.data && <p>Result - {result?.data}</p>}
        <button
          className="block w-full px-5 py-3 text-sm font-medium text-indigo-600 transition-all duration-300 border border-indigo-600 rounded-lg hover:bg-indigo-700 hover:text-white"
          onClick={closeModal}>
          Close
        </button>
      </div>
    </div>
  );
};

export default Result;
