type DividerProp = {
  fieldName: string;
  fontStyle: "normal" | "italic";
};

const Divider = ({ fieldName, fontStyle }: DividerProp) => {
  return (
    <div>
      <span className="relative flex justify-center">
        <div className="absolute inset-x-0 h-px -translate-y-1/2 bg-transparent opacity-75 top-1/2 bg-gradient-to-r from-transparent via-gray-500 to-transparent"></div>

        <span
          className={`relative z-5 bg-white md:text-xl px-6 ${
            fontStyle == "italic" && "italic"
          }`}>
          {fieldName}
        </span>
      </span>
    </div>
  );
};

export default Divider;
