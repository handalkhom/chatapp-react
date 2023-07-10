import React, { useEffect } from "react";
import { UserOutlined, DeleteOutlined, SendOutlined } from "@ant-design/icons";
import type { MenuProps } from "antd";
import axios from "axios";
import Cookies from "universal-cookie";
import {
    Avatar,
    List,
    Layout,
    theme,
    Dropdown,
    message,
    Input,
    Button,
    Space,
    Row,
    Col,
} from "antd";

const cookies = new Cookies();

const host = "http://127.0.0.1:8000";
const data = [
    {
        title: "Orang 1",
    },
    {
        title: "Orang 2",
    },
    {
        title: "Orang 3",
    },
    {
        title: "Orang 4",
    },
];

const handleButtonClick = (e: React.MouseEvent<HTMLButtonElement>) => {
    message.info("Click on left button.");
    console.log("click left button", e);
};

const handleMenuClick: MenuProps["onClick"] = (e) => {
    message.info("Click on menu item.");
    console.log("click", e);
};

const items: MenuProps["items"] = [
    {
        label: (
            <Avatar
                size={{
                    xs: 24,
                    sm: 32,
                    md: 40,
                    lg: 64,
                    xl: 80,
                    xxl: 100,
                }}
            />
        ),
        key: "1",
    },
    {
        label: "Update Profile Picture",
        key: "1",
        icon: <UserOutlined />,
    },
    {
        label: "Chat Baru",
        key: "2",
        icon: <UserOutlined />,
    },
    {
        label: "Logout",
        key: "3",
        icon: <UserOutlined />,
        danger: true,
    },
];

const menuProps = {
    items,
    onClick: handleMenuClick,
};

const { Header, Content, Footer, Sider } = Layout;

const simulateClick = (e) => {
    e.click();
};

const [recentMessageArr, setRecentMessageArr] = React.useState([]);

function recentMessage(search = "") {
    useEffect(() => {
        const room_id = 1;
        const token = cookies.get("token_login");
        let url = "";
        if (search != "") {
            url = `${host}/api/recentmessage?token=${token}&search=${search}`;
        } else {
            url = `${host}/api/recentmessage?token=${token}`;
        }

        axios.get(url).then(function (result) {
            // console.log(result);
            setRecentMessageArr(result.data);
        });
    });
}

recentMessage();

const [chatArr, setChatArr] = React.useState([]);

function chatHistory(room_id) {
    // useEffect(() => {
    const token = cookies.get("token_login");

    axios
        .get(`${host}/api/chathistory?token=${token}&room_id=${room_id}`)
        .then(function (result) {
            setChatArr(result.data.chats);
        });
    // });
}

const Dashboard: React.FC = () => {
    const {
        token: { colorBgContainer },
    } = theme.useToken();

    return (
        <Layout style={{ minHeight: "100vh" }}>
            <Sider
                style={{ width: 1000 }}
                theme="light"
                // collapsible
                // collapsed={collapsed}
                // onCollapse={(value) => setCollapsed(value)}
            >
                <Layout style={{ padding: "16px" }}>
                    <Space.Compact style={{ width: "100%" }}>
                        <Input defaultValue=" " />
                        <Dropdown menu={menuProps}>
                            <Button icon={<UserOutlined />} />
                        </Dropdown>
                    </Space.Compact>
                </Layout>
                <List
                    itemLayout="horizontal"
                    dataSource={recentMessageArr}
                    renderItem={(item, index) => (
                        <List.Item
                            data-id={item.room_id}
                            ref={simulateClick}
                            onClick={() => chatHistory(item.room_id)}
                            className="item_recent_message"
                        >
                            <List.Item.Meta
                                avatar={<Avatar src={item.profile_img} />}
                                title={
                                    <div style={{ textAlign: "left" }}>
                                        {item.nama_kontak}
                                    </div>
                                }
                                description={
                                    <div style={{ textAlign: "left" }}>
                                        {item.last_chat}
                                    </div>
                                }
                            />
                        </List.Item>
                    )}
                />
                {/* <Footer
                    style={{
                        position: "relative",
                        top: "35%",
                        // textAlign: "center",
                        width: "100%",
                    }}
                >
                    <Avatar
                        size={{
                            xs: 24,
                            sm: 32,
                            md: 40,
                            lg: 64,
                            xl: 80,
                            xxl: 100,
                        }}
                        icon={<UserOutlined />}
                    />
                </Footer> */}
            </Sider>
            <Layout>
                <Header
                    style={{
                        padding: 0,
                        background: colorBgContainer,
                        textAlign: "left",
                        paddingLeft: "20px",
                    }}
                >
                    <Avatar
                        src={`https://xsgames.co/randomusers/avatar.php?g=pixel&key=1`}
                    />
                    <span
                        style={{
                            marginLeft: "10px",
                        }}
                    >
                        Orang
                    </span>
                </Header>
                <Content style={{ margin: "0 16px" }}>
                    {/* <div
                        style={{
                            padding: 24,
                            margin: "16px 0",
                            minHeight: 360,
                            background: colorBgContainer,
                        }}
                    >
                        <li>
                            <div>
                                <span></span>
                            </div>
                        </li>
                    </div> */}
                    {chatArr.map((chat, index) => {
                        return (
                            <div data-id={chat.chat_id}>
                                {chat.pengirim_id == 1 ? (
                                    <Row>
                                        <Col
                                            span={20}
                                            style={{
                                                textAlign: "left",
                                                marginTop: 5,
                                                marginBottom: 5,
                                            }}
                                        >
                                            <div
                                                style={{
                                                    padding: 10,
                                                    backgroundColor: "#eaeaea",
                                                    textAlign: "left",
                                                    borderRadius: 7,
                                                    display: "inline-block",
                                                    minWidth: 200,
                                                }}
                                            >
                                                <span
                                                    style={{
                                                        display: "block",
                                                    }}
                                                >
                                                    {chat.isi}
                                                </span>
                                                <small
                                                    style={{
                                                        display: "block",
                                                        textAlign: "right",
                                                        marginRight: "10px",
                                                        marginTop: "5px",
                                                    }}
                                                >
                                                    {/* 27 Juli, 10:20 AM */}
                                                    {chat.date_created}
                                                </small>
                                            </div>
                                        </Col>
                                    </Row>
                                ) : (
                                    <Row>
                                        <Col
                                            offset={4}
                                            span={20}
                                            style={{
                                                textAlign: "right",
                                                marginTop: 5,
                                                marginBottom: 5,
                                            }}
                                        >
                                            <div
                                                style={{
                                                    padding: 10,
                                                    backgroundColor: "#eaeaea",
                                                    textAlign: "left",
                                                    borderRadius: 7,
                                                    display: "inline-block",
                                                    minWidth: 200,
                                                }}
                                            >
                                                <span
                                                    style={{
                                                        display: "block",
                                                    }}
                                                >
                                                    {chat.isi}
                                                </span>
                                                <small
                                                    style={{
                                                        display: "block",
                                                        textAlign: "right",
                                                        marginRight: "10px",
                                                        marginTop: "5px",
                                                    }}
                                                >
                                                    {chat.date_created}
                                                </small>
                                            </div>
                                            <Button icon={<DeleteOutlined />} />
                                        </Col>
                                    </Row>
                                )}
                            </div>
                        );
                    })}
                </Content>
                <Footer style={{ textAlign: "center" }}>
                    <Space.Compact style={{ width: "100%" }}>
                        <Input placeholder="Ketik pesan" />;
                        <Button icon={<SendOutlined />} />
                    </Space.Compact>
                </Footer>
            </Layout>
        </Layout>
    );
};

export default Dashboard;
