import { fireEvent, render, screen, waitFor } from "@testing-library/react";
import CalculatorForm from "./CalculatorForm";

it("renders 'Upload instruction file to calculate' description", () => {
  render(<CalculatorForm />);
  const description = screen.queryByText(
    /Upload instruction file to calculate/i
  );
  expect(description).toBeVisible();
});

it("renders 'The instruction file should look like this' description", () => {
  render(<CalculatorForm />);
  const description = screen.queryByText(
    /The instruction file should look like this/i
  );
  expect(description).toBeVisible();
});

it("renders 'Calculate' button", () => {
  render(<CalculatorForm />);
  const button = screen.getByRole("button", { name: /calculate/i });
  expect(button).toBeVisible();
});

it("renders Result component after form submission", async () => {
  render(<CalculatorForm />);

  const file = new File(["instruction content"], "instructions.txt", {
    type: "text/plain",
  });

  const fileInput = screen.getByLabelText(/file/i);
  fireEvent.change(fileInput, { target: { files: [file] } });

  const form = screen.getByTestId("calculator-form");
  fireEvent.submit(form);

  await waitFor(() => {
    const resultComponent = screen.getByTestId("result-component");
    expect(resultComponent).toBeInTheDocument();
  });
});
