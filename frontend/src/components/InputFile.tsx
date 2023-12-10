import { useRef, useState } from "react";

type InputProp = {
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
};

const InputFile = ({ onChange }: InputProp) => {
  const [fileName, setFileName] = useState<string | null>(null);
  const fileRef = useRef(null);

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    onChange(e);
    if (e.target.files) {
      setFileName(e.target.files[0].name);
    }
  };

  return (
    <label className="flex justify-center px-3 py-6 text-sm transition bg-white border border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:border-solid focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:opacity-75">
      <span className="flex items-center space-x-2">
        <svg className="w-6 h-6 stroke-gray-400" viewBox="0 0 256 256">
          <path
            d="M96,208H72A56,56,0,0,1,72,96a57.5,57.5,0,0,1,13.9,1.7"
            fill="none"
            strokeLinecap="round"
            strokeLinejoin="round"
            strokeWidth="24"></path>
          <path
            d="M80,128a80,80,0,1,1,144,48"
            fill="none"
            strokeLinecap="round"
            strokeLinejoin="round"
            strokeWidth="24"></path>
          <polyline
            points="118.1 161.9 152 128 185.9 161.9"
            fill="none"
            strokeLinecap="round"
            strokeLinejoin="round"
            strokeWidth="24"></polyline>
          <line
            x1="152"
            y1="208"
            x2="152"
            y2="128"
            fill="none"
            strokeLinecap="round"
            strokeLinejoin="round"
            strokeWidth="24"></line>
        </svg>
        <span className="text-xs font-medium text-gray-600">
          {fileName ?? "Browse file to upload"}
        </span>
      </span>
      <input
        id="photo-dropbox"
        type="file"
        ref={fileRef}
        accept="text/plain"
        onChange={handleFileChange}
        className="sr-only"
      />
    </label>
  );
};

export default InputFile;
