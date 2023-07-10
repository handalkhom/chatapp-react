import React from "react";
import { LockOutlined, UserOutlined } from "@ant-design/icons";
import { Layout, theme, Button, Checkbox, Form, Input } from "antd";
import { Link } from "react-router-dom";
import axios from "axios";
import Cookies from "universal-cookie";

const { Header, Content, Footer } = Layout;
const host = "http://127.0.0.1:8000";
const cookies = new Cookies();

const onFinish = (values: any) => {
    const data = {
        username: values.username,
        password: values.password,
    };
    axios.post(host + "/api/login", data).then(function (result) {
        // chatArr = result;
        // console.log(result);
        const data = result.data;
        if (data.status == "success") {
            alert(data.message);
            cookies.set("token_login", data.token);
            document.location.href = "/dashboard";
        } else {
            alert(data.message);
        }
    });
    // console.log("Success:", values);
};

// const onFinishFailed = (errorInfo: any) => {
//     console.log("Failed:", errorInfo);
// };

const Login: React.FC = () => {
    const {
        token: { colorBgContainer },
    } = theme.useToken();

    return (
        <Layout>
            <Header
                style={{
                    position: "sticky",
                    top: 0,
                    zIndex: 1,
                    width: "100%",
                    display: "flex",
                    alignItems: "center",
                    fontWeight: "bold",
                    color: "White",
                }}
            >
                LOGIN
            </Header>
            <Content
                className="site-layout"
                style={{
                    padding: "50px",
                    display: "flex",
                    justifyContent: "center",
                }}
            >
                <Form
                    name="normal_login"
                    className="login-form"
                    initialValues={{ remember: true }}
                    onFinish={onFinish}
                    style={{
                        padding: "50px",
                        maxWidth: 600,
                        width: "100%",
                        // margin: "50px 30%",
                    }}
                >
                    <Form.Item
                        name="username"
                        rules={[
                            {
                                required: true,
                                message: "Please input your Username!",
                            },
                        ]}
                    >
                        <Input
                            prefix={
                                <UserOutlined className="site-form-item-icon" />
                            }
                            placeholder="Username"
                        />
                    </Form.Item>
                    <Form.Item
                        name="password"
                        rules={[
                            {
                                required: true,
                                message: "Please input your Password!",
                            },
                        ]}
                    >
                        <Input
                            prefix={
                                <LockOutlined className="site-form-item-icon" />
                            }
                            type="password"
                            placeholder="Password"
                        />
                    </Form.Item>
                    {/* <Form.Item>
                        <Form.Item
                            name="remember"
                            valuePropName="checked"
                            noStyle
                        >
                            <Checkbox>Remember me</Checkbox>
                        </Form.Item>
                    </Form.Item> */}

                    <Form.Item>
                        <Button
                            type="primary"
                            htmlType="submit"
                            className="login-form-button"
                        >
                            Log in
                        </Button>
                        Or <Link to="/register">Register now!</Link>
                    </Form.Item>
                </Form>
            </Content>
            <Footer style={{ textAlign: "center" }}>
                Ant Design ©2023 Created by Ant UED
            </Footer>
        </Layout>
    );
};

export default Login;
