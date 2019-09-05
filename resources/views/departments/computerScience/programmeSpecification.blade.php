@extends('layouts.frontend')
@section('title')
	Computer Science - Programme Specification
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<nav aria-label="breadcrumb" class="breadcrumb-container">
		  <ol class="breadcrumb" style="background-color: transparent">
		    <li class="breadcrumb-item"><a href="{{url('/departments/overview')}}">Departments</a></li>
		    <li class="breadcrumb-item"><a href="{{url('/departments/computerScience/word')}}">Computer Science</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Programme Specification</li>
		  </ol>
		</nav>
		<h1 style="font-size: 30px;margin-bottom:80px;font-weight: bold">Programme Specification</h1>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">A- Basic Information</h2>
		<p>
			1- Programme Title: Computer Science<br>

2- Programme Type:    Single                          Double                                    Multiple<br>

3- Department(s): Computer Science<br>

4- Coordinator: Prof. Dr. Iraqy Khalifa<br>

5- Last Date of Programme Specification Approval: Jan 2010<br>

6- Year: 2010
		</p>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">B- Professional Information</h2>
		<ol>
			<li>Programme aims
				<ol>
					<li>Enable graduates to exhibit a high level of practical and theoretical skills over a broad range of Computer Science together with knowledge of currently available techniques and technologies.</li>
					<li> Explore the principles that support developments in a rapidly changing environment.</li>
					<li>Provide opportunities for students to understand the wide range of research challenges facing Computer Science, as well as the breadth and depth of research undertaken in this top-rated school, so they are prepared to get on research here or elsewhere.</li>
					<li>Develop competent professionals able to play a leading part in many different commercial, industrial and academic activities and adapt rapidly to changing technology.</li>
					<li>Meet industry demand for high caliber graduates who will take a lead in continuing technological change.</li>
					<li>Prepare students for the social, organizational and professional context in which they will be working.</li>
				</ol>
			</li>
			<li>Intended Learning Outcomes (ILOs)
				<ul>
					<li>A- Knowledge and understanding
						<ul>
						<p>
							{!! nl2br('A1. Apply the basics of Physics.

A2. Apply the basics of Electronics for Digital Design.

A3. Describe and model Mathematical Problems.

A4. Apply the basics of Calculus.

A5. Apply the Statistical Methods.

A6. Describe the Modeling Problems.

A7. Define the basics of Computer Systems.

A8. Apply Programming to solve Problems.

A9. Apply the Problem Solving Techniques.

A10. Apply the basics of Discrete Mathematics.

A11. Recognize Operating Systems Designs.

A12. Demonstrate the basics of Computer Components.

A13. Apply the Data Analysis process.

A14. Elaborate Selected Topics in Pattern Recognition and Image Processing.

A15. Recognize Artificial Intelligent Principles.

A16. Represent essential knowledge of Computer Graphics.

A17. Represent essential knowledge of Translators Design.

A18. Recognize Computer Networks.

A19. Outline the principles of Software Engineering.

A20. Extrapolate the engineering process of software production.

A21. Apply the principles of Object-Oriented Programming.

A22. Identify the basics of Economics and Management.

A23. Recognize the logic of Digital Circuits.

A24. Abstract the principles of Information Systems.

A25. Apply the principles of Internet Technologies.

A26. Apply the principles of Information Technologies.

A27. Clarify advanced topics in Computer Science.') !!}
						</p>
						</ul>
					</li>
					<li>
						B- Intellectual skills
						<ul>
						<p>
							{!! nl2br('B1. Recognize and assemble components.

B2. Select appropriate Mathematical method to solve a specific problem.

B3. Develop Analytical Skills.

B4. Formulate and test Concepts and Hypothesis.

B5. Collaborate Modeling and Simulation.

B6. Diagnose the potential and the limitations of Computers.

B7. Create computer algorithms to solve different problems.  

B8. Gather and assess relevant information, using abstract ideas to interpret it effectively.

B9. Design and implement Programming methods.  

B10. Distinguish Diagnosis Techniques.

B11. Plan, conduct and present Software Projects.

B12. Locate and assess the strengths and weaknesses of the problem argument (Critical reasoning).

B13. Design different Pattern Recognition techniques.  

B14. Develop the act of getting people together to accomplish desired goals and objectives (Management skills).

B15. Focus, gather information, integrate, and evaluate the data for Problem Solving.

B16. Work effectively, independently or as a part of a team.

B17. Examine problems carefully and effectively.

B18. Classify different problems.

B19. Devise a solution to practical problems.

B20. Design software solutions to real world problems.

B21. Design and analyze Problems.

B22. Compare methods with data.

B23. Classify different Data types.

B24. Represent Data structures.') !!}
						</p>
						</ul>
					</li>
					<li>D- General and Transferable skills
						<ul>
							<p>
								{!! nl2br('D1. Practice Communication skills in English.

D2. Practice Independent Learning techniques.

D3. Use different Problem solving techniques.

D4. Follow Analytical Thinking.

D5. Follow Creative Thinking.

D6. Use Modeling capability in software projects.

D7. Use Effective reasoning in problem solving.

D8. Practice Management Skills.

D9. Follow ethics in research and work.

D10. Specify the applied human rights.

D11. Clarify Ideas formulation and presentation.

D12. Use Logical inference in problem solving.

D13. Practice Designing skills in software projects.

D14. Practice Engineering skills for software development.')!!}
							</p>
						</ul>
					</li>
				</ul>
			</li>
		</ol>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Message Department</h2>
		<p>
			Emanate message section of the mission of the College , which are summarized in the provision of educational services and distinguished research students keep pace with the quality standards of local and global in the fields of computer science , allowing the preparation of a distinguished graduate competitive in addition to the completion of scientific research upscale and active participation in community service and the surrounding environment .
Objectives
		</p>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Emanate goals section of the objectives of the College as follows:</h2>
		<ol>
			<li>The preparation of a distinguished graduate in the fields of computer science and programming and software engineering is able to compete in local labor markets , regional and global .</li>
			<li>Continuous improvement in academic programs and educational systems and research in line with the requirements of preparing a distinguished graduate competitive .</li>
			<li>Achieve excellence through studies and scientific and applied research in the areas of specialization.</li>
			<li>Service sector, the government and public business sector and civil society by organizing consulting and technical assistance to them and training the human resources capable of meeting the needs of these sectors in the areas of computer science and technology networks and the Internet.</li>
		</ol>
	</div>
@endsection