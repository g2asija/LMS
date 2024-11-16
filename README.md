# LMS
Please refer this read me to understand how to run project and how much goals are accomplished. Thank you very much.
-- Completed -- 
1) Create Loan
A user should be able to create a new loan
High
A loan can have loan amount(e.g. $50,000), interest rate(e.g. 15%) and loan duration(e.g. 3 years)

http://localhost/LMS/loans/create.php
{
    "id":10,
    "LenderId":10,
    "Amount":30.0,
    "duration":5,
    "borrowerId":5,
    "Rate":7.0,
    "isClosed":1,
    "Date":"2024-11-15"
}
    "message": "Loan was created."

--- Completed ---- 
2) Edit Loan
A user should be able to edit an existing loan
High

http://localhost/LMS/loans/update.php
{
    "id":10,
    "LenderId":10,
    "Amount":31.0,
    "duration":5,
    "borrowerId":5,
    "Rate":7.0,
    "isClosed":1,
    "Date":"2024-11-15"
}
Please check your loan and lender information{
    "message": "Unable to update loan."
}

--Completed--

3) Delete Loan
A user should be able to delete an existing loan
High
http://localhost/LMS/loans/delete.php
{
    "id":10,
    "LenderId":10 
}
--Completed--

4) Read Loans List
A user should be able to pull all loans
High

For reading all loans;
http://localhost/LMS/loans/read.php
For reading particular entry:
http://localhost/LMS/loans/read.php?id=1

--Completed---
Create Loan Lender
Each loan should be associated with a lender
Med
Stretch goal

---Completed--
Edit Loan lender
Only the original lender of the loan should be able to edit it
Med
Stretch goal

Data sql is in loandatabase.sql

#Rest of the items are TODO


