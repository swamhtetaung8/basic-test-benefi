import { FormEvent, useState } from "react";
import InputFile from "./InputFile";
import Result from "./Result";
import axios from "axios";
import { api } from "../services/api";

export type ResponseObject =
  | {
      status: string;
      data: string | null;
      message: string | null;
    }
  | undefined;

const CalculatorForm = () => {
  const [file, setFile] = useState<File | null>(null);
  const [result, setResult] = useState<ResponseObject>();
  const [openModal, setOpenModal] = useState<boolean>(false);

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files) {
      setFile(e.target.files[0]);
    }
  };

  const handleFileSubmit = async (e: FormEvent) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("file", file as File);
    try {
      const { data } = await axios.post(api.calculate, formData);
      setResult(data);
      setOpenModal(true);
    } catch (e) {
      // Handle the error based on its type or any other criteria
      if (axios.isAxiosError(e)) {
        console.error("Axios error:", e.response?.data);
        setResult(e.response?.data);
        setOpenModal(true);
      } else {
        console.error(e);
      }
    }
  };

  return (
    <div className="flex-1 max-w-screen-xl px-4 py-16 mx-auto">
      <div className="max-w-lg mx-auto">
        <form
          data-testid="calculator-form"
          onSubmit={handleFileSubmit}
          action=""
          encType="multipart/form-data"
          className="p-4 mt-6 mb-0 space-y-4 border border-gray-300 rounded-lg sm:p-6 lg:p-8">
          <p className="text-lg font-medium text-center">
            Upload instruction file to calculate
          </p>
          <p className="text-lg font-medium text-center">
            The instruction file should look like this 👉🏻
          </p>

          <div>
            <label htmlFor="file" className="sr-only">
              File
            </label>

            <div className="relative">
              <InputFile onChange={handleFileChange} />
            </div>
          </div>

          <button
            type="submit"
            className="block w-full px-5 py-3 text-sm font-medium text-white transition-all duration-300 bg-indigo-600 rounded-lg hover:bg-indigo-700">
            Calculate
          </button>
        </form>
      </div>
      {openModal && <Result result={result} setOpenModal={setOpenModal} />}
    </div>
  );
};

export default CalculatorForm;
