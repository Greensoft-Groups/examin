 file name:employee.java

package net.javaguides.demoweb.model;

public class employee {
	private  String firstName;
	private  String lastName;	
	private  String username;
	private  String password;
	private  String address;
	private  String contact;
	public String getFirstName() {
		return firstName;
	}
	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}
	public String getLastName() {
		return lastName;
	}
	public void setLastName(String lastName) {
		this.lastName = lastName;
	}
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getAddress() {
		return address;
	}
	public void setAddress(String address) {
		this.address = address;
	}
	public String getContact() {
		return contact;
	}
	public void setContact(String contact) {
		this.contact = contact;
	}
	public String getusername() {
		// TODO Auto-generated method stub
		return null;
	}
	
	
}

********************************************************************************************************************

file name: employeeDao.java

package net.javaguides.demoweb.dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import net.javaguides.demoweb.model.employee;

public class employeeDao {
	 public static int registerEmployee(employee employee) throws ClassNotFoundException {
	      String INSERT_USERS_SQL = "INSERT INTO employee  (id, first_name, last_name, username, password, address, contact) VALUES  (?, ?, ?, ?, ?,?,?);";
	      int result = 0;
	      Class.forName("com.mysql.jdbc.Driver");
 
	         try (
	            Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/employee?useSSL=false", "root", "root");

	               PreparedStatement preparedStatement = connection.prepareStatement(INSERT_USERS_SQL);
	        		 )
	         {
	                  preparedStatement.setInt(1, 1);
	                  preparedStatement.setString(2, employee.getFirstName());
	                  preparedStatement.setString(3, employee.getLastName());
	                  preparedStatement.setString(4, employee.getUsername());
	                  preparedStatement.setString(5, employee.getPassword());
	                  preparedStatement.setString(6, employee.getAddress());
	                  preparedStatement.setString(7, employee.getContact());
	                  System.out.println(preparedStatement);
	                  result = preparedStatement.executeUpdate();
	                
	      } catch (SQLException e) 
	      {
	         e.printStackTrace();
	      }

	      return result;
	   
	 		}
	   }



********************************************************************************************************************


file name: EmployeeServlet.java

package net.javaguides.demoweb.controller;

import jakarta.servlet.RequestDispatcher;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import net.javaguides.demoweb.dao.employeeDao;
import net.javaguides.demoweb.model.employee;
import java.io.IOException;

/**
 * Servlet implementation class EmployeeServlet
 */
@WebServlet("/register")
public class EmployeeServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private employeeDao EmployeeDao= new employeeDao();
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public EmployeeServlet() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ").append(request.getContextPath());
		RequestDispatcher dispatcher = request.getRequestDispatcher("/WEB-INF/views/employeeregister.jsp");
		dispatcher.forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		String firstName=request.getParameter("firstName");
		String lastName=request.getParameter("lastName");
		String username=request.getParameter("username");
		String password=request.getParameter("password");
		String address=request.getParameter("address");
		String contact=request.getParameter("contact");
		
		employee Employee = new employee();
		Employee.setFirstName(firstName);
		Employee.setLastName(lastName);
		Employee.setUsername(username);
		Employee.setPassword(password);
		Employee.setAddress(address);
		Employee.setContact(contact);
		
		try {
		employeeDao.registerEmployee(Employee);
		}catch(ClassNotFoundException e) {
			e.printStackTrace();
		}
		RequestDispatcher dispatcher = request.getRequestDispatcher("/WEB-INF/views/employeedetails.jsp");
		dispatcher.forward(request, response);
		}

	public employeeDao getEmployeeDao() {
		return EmployeeDao;
	}

	public void setEmployeeDao(employeeDao employeeDao) {
		EmployeeDao = employeeDao;
	}
	
	}

********************************************************************************************************************

file name: employeeregister.jsp


<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
 pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
 <div align="center">
  <h1>Employee Register Form</h1>
  <form action="<%= request.getContextPath() %>/register" method="post">
   <table style="with: 80%">
    <tr>
     <td>First Name</td>
     <td><input type="text" name="firstName" /></td>
    </tr>
    <tr>
     <td>Last Name</td>
     <td><input type="text" name="lastName" /></td>
    </tr>
    <tr>
     <td>UserName</td>
     <td><input type="text" name="username" /></td>
    </tr>
    <tr>
     <td>Password</td>
     <td><input type="password" name="password" /></td>
    </tr>
    <tr>
     <td>Address</td>
     <td><input type="text" name="address" /></td>
    </tr>
    <tr>
     <td>Contact No</td>
     <td><input type="text" name="contact" /></td>
    </tr>
   </table>
   <input type="submit" value="Submit" />
  </form>
 </div>
</body>
</html>


********************************************************************************************************************
file name: employeedetails.jsp


<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
 pageEncoding="ISO-8859-1"%>
<%@page import="net.javaguides.demoweb.dao.*"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
 <h1>User successfully registered!</h1>
</body>
</html>